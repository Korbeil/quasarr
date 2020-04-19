<?php

namespace App\MessageHandler;

use App\Entity\Torrent;
use App\Entity\TvEpisode;
use App\Enum\ResourceStatus;
use App\Message\DownloadTvEpisodeMessage;
use App\Message\DownloadTvSeasonMessage;
use App\Repository\TvSeasonRepository;
use App\Repository\TvShowRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use TMDB\API\Client;
use Transmission\Client as TransmissionClient;

final class DownloadTvSeasonMessageHandler implements MessageHandlerInterface
{
    use BestResultTrait;

    private $doctrine;
    private $tvShowRepository;
    private $tvSeasonRepository;
    private $transmissionClient;
    private $tmdbClient;
    private $jackettClient;
    private $bus;

    public function __construct(ManagerRegistry $doctrine,
        TvShowRepository $tvShowRepository,
        TvSeasonRepository $tvSeasonRepository,
        TransmissionClient $transmissionClient,
        Client $tmdbClient,
        HttpClientInterface $jackettClient,
        MessageBusInterface $bus)
    {
        $this->tvShowRepository = $tvShowRepository;
        $this->tvSeasonRepository = $tvSeasonRepository;
        $this->doctrine = $doctrine;
        $this->transmissionClient = $transmissionClient;
        $this->tmdbClient = $tmdbClient;
        $this->jackettClient = $jackettClient;
        $this->bus = $bus;
    }

    public function __invoke(DownloadTvSeasonMessage $message)
    {
        $tvShow = $this->tvShowRepository->find($message->getTvShowId());
        $tvSeason = $this->tvSeasonRepository->findOneBy([
            'number' => $message->getNumber(),
            'tvShow' => $tvShow,
        ]);
        $seasonNumberPadded = str_pad($tvSeason->getNumber(), 2, '0', STR_PAD_LEFT);

        $queries = [
            sprintf('%s S%s', $tvShow->getTitle(), $seasonNumberPadded),
            sprintf('%s Season %s', $tvShow->getTitle(), $seasonNumberPadded),
            sprintf('%s Saison %s', $tvShow->getTitle(), $seasonNumberPadded),
        ];

        $responses = [];
        foreach ($queries as $query) {
            // search for full season, if not found, search episode by episode
            $responses[] = $this->jackettClient->request('GET', 'api/v2.0/indexers/all/results', [
                'query' => [
                    'Query' => $query,
                    'Category' => [5000, 5070],
                ],
            ]);
        }

        $results = [];

        // handle results of each query, choose the best (implement quality and vostfr ?)
        foreach ($responses as $response) {
            $results = array_merge($results, json_decode($response->getContent())->Results);
        }

        $bestTorrent = $this->findBestTorrent($results);

        if ($bestTorrent) {
            $transmissionTorrent = $this->transmissionClient->addUrl($bestTorrent->Link)->toArray();

            $torrent = new Torrent();
            $torrent->setHash($transmissionTorrent['hashString'])
                ->setCompleted(false)
                ->setMediaId($tvSeason->getId())
                ->setMediaType(Torrent::TVSEASON_TYPE);
            $this->doctrine->getManager()->persist($torrent);

            $tvSeason->setStatus(ResourceStatus::DOWNLOADING);

            $this->doctrine->getManager()->flush();
        } else {
            // This will avoid to search again full season as we now search by episode.
            $tvSeason->setStatus(ResourceStatus::PROCESSED);

            $tmdbTvShow = $this->tmdbClient->getTvShowDetails($tvShow->getIdTmdb());

            $tmdbTvSeason = null;
            foreach ($tmdbTvShow->getSeasons() as $season) {
                $tmdbTvSeason = $season->getSeasonNumber() === $tvSeason->getNumber() ? $season : null;
            }

            if ($tmdbTvSeason) {
                foreach (range(1, $tmdbTvSeason->getEpisodeCount()) as $episodeNumber) {
                    $tvEpisode = new TvEpisode();
                    $tvEpisode->setNumber($episodeNumber)
                        ->setShow($tvShow)
                        ->setSeason($tvSeason)
                        ->setStatus(ResourceStatus::MISSING);
                    $this->doctrine->getManager()->persist($tvEpisode);

                    $this->bus->dispatch(new DownloadTvEpisodeMessage($tvShow->getId(), $tvSeason->getId(), $tvEpisode->getNumber()));
                }

                $this->doctrine->getManager()->flush();
            } else {
                // @todo: log not found DB stored season on TMDB
            }
        }
    }
}

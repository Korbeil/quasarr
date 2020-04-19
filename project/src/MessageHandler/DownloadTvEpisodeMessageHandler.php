<?php

namespace Quasarr\MessageHandler;

use Doctrine\Persistence\ManagerRegistry;
use Quasarr\Entity\Torrent;
use Quasarr\Enum\ResourceStatus;
use Quasarr\Message\DownloadTvEpisodeMessage;
use Quasarr\Repository\TvEpisodeRepository;
use Quasarr\Repository\TvSeasonRepository;
use Quasarr\Repository\TvShowRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Transmission\Client as TransmissionClient;

final class DownloadTvEpisodeMessageHandler implements MessageHandlerInterface
{
    use BestResultTrait;

    private $doctrine;
    private $tvShowRepository;
    private $tvSeasonRepository;
    private $tvEpisodeRepository;
    private $transmissionClient;
    private $jackettClient;

    public function __construct(ManagerRegistry $doctrine,
        TvShowRepository $tvShowRepository,
        TvSeasonRepository $tvSeasonRepository,
        TvEpisodeRepository $tvEpisodeRepository,
        TransmissionClient $transmissionClient,
        HttpClientInterface $jackettClient)
    {
        $this->tvShowRepository = $tvShowRepository;
        $this->tvSeasonRepository = $tvSeasonRepository;
        $this->tvEpisodeRepository = $tvEpisodeRepository;
        $this->doctrine = $doctrine;
        $this->transmissionClient = $transmissionClient;
        $this->jackettClient = $jackettClient;
    }

    public function __invoke(DownloadTvEpisodeMessage $message)
    {
        $tvShow = $this->tvShowRepository->find($message->getTvShowId());
        $tvEpisode = $this->tvEpisodeRepository->findOneBy([
            'number' => $message->getTvEpisodeNumber(),
            'show' => $message->getTvShowId(),
            'season' => $message->getTvSeasonId(),
        ]);
        $seasonNumberPadded = str_pad($tvEpisode->getSeason()->getNumber(), 2, '0', STR_PAD_LEFT);
        $episodeNumberPadded = str_pad($tvEpisode->getNumber(), 2, '0', STR_PAD_LEFT);

        $queries = [
            sprintf('%s S%sE%s', $tvShow->getTitle(), $seasonNumberPadded, $episodeNumberPadded),
            sprintf('%s Season %s Episode %s', $tvShow->getTitle(), $seasonNumberPadded, $episodeNumberPadded),
            sprintf('%s Saison %s Episode %s', $tvShow->getTitle(), $seasonNumberPadded, $episodeNumberPadded),
        ];

        $responses = [];
        foreach ($queries as $query) {
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
                ->setMediaId($tvEpisode->getId())
                ->setMediaType(Torrent::TVEPISODE_TYPE);
            $this->doctrine->getManager()->persist($torrent);

            $tvEpisode->setStatus(ResourceStatus::DOWNLOADING);

            $this->doctrine->getManager()->flush();
        }
    }
}

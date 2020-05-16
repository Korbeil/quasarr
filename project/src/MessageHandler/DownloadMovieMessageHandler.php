<?php

namespace App\MessageHandler;

use App\Entity\Torrent;
use App\Enum\ResourceStatus;
use App\Message\DownloadMovieMessage;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Transmission\Client as TransmissionClient;

final class DownloadMovieMessageHandler implements MessageHandlerInterface
{
    use BestResultTrait;

    private $doctrine;
    private $movieRepository;
    private $jackettClient;
    private $transmissionClient;

    public function __construct(ManagerRegistry $doctrine, MovieRepository $movieRepository, HttpClientInterface $jackettClient, TransmissionClient $transmissionClient)
    {
        $this->movieRepository = $movieRepository;
        $this->doctrine = $doctrine;
        $this->jackettClient = $jackettClient;
        $this->transmissionClient = $transmissionClient;
    }

    public function __invoke(DownloadMovieMessage $message)
    {
        $movie = $this->movieRepository->find($message->getId());
        $response = $this->jackettClient->request('GET', 'api/v2.0/indexers/all/results', [
            'query' => [
                'Query' => $movie->getTitle(),
                'Category' => [2000],
            ],
        ]);

        $results = json_decode($response->getContent())->Results;

        $bestTorrent = $this->findBestTorrent($results, Torrent::MOVIE_TYPE);

        if ($bestTorrent) {
            $transmissionTorrent = $this->transmissionClient->addUrl($bestTorrent->Link)->toArray();

            $torrent = new Torrent();
            $torrent->setHash($transmissionTorrent['hashString'])
                ->setCompleted(false)
                ->setMediaId($movie->getId())
                ->setMediaType(Torrent::MOVIE_TYPE);
            $this->doctrine->getManager()->persist($torrent);

            $movie->setStatus(ResourceStatus::DOWNLOADING);

            $this->doctrine->getManager()->flush();
        }
    }
}

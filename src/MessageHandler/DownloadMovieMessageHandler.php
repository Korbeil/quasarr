<?php

namespace App\MessageHandler;

use App\Entity\Torrent;
use App\Enum\ResourceStatus;
use App\Message\DownloadMovieMessage;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Transmission\Client as TransmissionClient;

final class DownloadMovieMessageHandler implements MessageHandlerInterface
{
    use JackettAwareTrait;

    private $doctrine;
    private $movieRepository;
    private $transmissionClient;

    public function __construct(ManagerRegistry $doctrine,
        MovieRepository $movieRepository,
        TransmissionClient $transmissionClient,
        string $jackettUrl,
        string $jackettApiKey)
    {
        $this->movieRepository = $movieRepository;
        $this->doctrine = $doctrine;
        $this->createJackettClient($jackettUrl, $jackettApiKey);
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
        $transmissionTorrent = $this->transmissionClient->addUrl($results[0]->Link)->toArray();

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

<?php

namespace Quasarr\Command;

use Quasarr\Entity\Movie;
use Quasarr\Entity\Torrent;
use Quasarr\Entity\TvEpisode;
use Quasarr\Entity\TvSeason;
use Quasarr\Enum\ResourceStatus;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Transmission\Client;

class CheckTorrentsCommand extends Command
{
    protected static $defaultName = 'check:torrents';

    private $transmissionClient;
    private $doctrine;
    private $movieRepository;
    private $tvSeasonRepository;
    private $tvEpisodeRepository;
    private $torrentRepository;

    protected function configure()
    {
        $this->setDescription('Check torrents download progress, and process downloaded ones.');
    }

    public function __construct(Client $transmissionClient, ManagerRegistry $doctrine)
    {
        $this->transmissionClient = $transmissionClient;
        $this->doctrine = $doctrine;
        $this->movieRepository = $doctrine->getRepository(Movie::class);
        $this->tvSeasonRepository = $doctrine->getRepository(TvSeason::class);
        $this->tvEpisodeRepository = $doctrine->getRepository(TvEpisode::class);
        $this->torrentRepository = $doctrine->getRepository(Torrent::class);

        parent::__construct(static::$defaultName);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $downloadingMovies = $this->movieRepository->findBy([
            'status' => ResourceStatus::DOWNLOADING,
        ]);
        $downloadingSeasons = $this->tvSeasonRepository->findBy([
            'status' => ResourceStatus::DOWNLOADING,
        ]);
        $downloadingEpisodes = $this->tvEpisodeRepository->findBy([
            'status' => ResourceStatus::DOWNLOADING,
        ]);

        foreach ($downloadingMovies as $downloadingMovie) {
            $torrent = $this->torrentRepository->findOneBy([
                'mediaId' => $downloadingMovie->getId(),
                'mediaType' => Torrent::MOVIE_TYPE,
            ]);

            if ($torrent instanceof Torrent) {
                // log something
                continue;
            }

            $this->checkTorrent($torrent);
        }

        return 0;
    }

    private function checkTorrent(Torrent $torrent)
    {
        /** @var \Transmission\Models\Torrent $transmissionTorrent */
        $transmissionTorrent = $this->transmissionClient->get($torrent->getHash())->first();

        if ($transmissionTorrent->isDone()) {
            if (Torrent::MOVIE_TYPE === $torrent->getMediaType()) {
                $movie = $this->movieRepository->find($torrent->getMediaId());
                $movie->setStatus(ResourceStatus::DOWNLOADED);
                $this->doctrine->getManager()->flush();
                // @todo send message into RenameAndLinkQueue
            }
        }
    }
}

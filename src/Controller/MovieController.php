<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Torrent;
use App\Enum\ResourceStatus;
use App\Message\DownloadMovieMessage;
use App\Repository\MovieRepository;
use App\Repository\TorrentRepository;
use App\TMDB\Authentication\ApiKeyAuthentication;
use App\TMDB\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Transmission\Client as TransmissionClient;

class MovieController extends AbstractController
{
    private $tmdbClient;
    private $transmissionClient;

    public function __construct(string $tmdbApiKey, TransmissionClient $transmissionClient)
    {
        $this->tmdbClient = Client::create(null, new ApiKeyAuthentication($tmdbApiKey));
        $this->transmissionClient = $transmissionClient;
    }

    /**
     * @Route("/movies", name="list_movies")
     */
    public function list(TorrentRepository $torrentRepository, MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        $torrents = [];

        foreach ($movies as $movie) {
            $torrent = $torrentRepository->findOneBy([
                'mediaType' => Torrent::MOVIE_TYPE,
                'mediaId' => $movie->getId(),
            ]);

            if ($torrent instanceof Torrent) {
                $transmissionTorrents = $this->transmissionClient->get($torrent->getHash());
                $torrents[$movie->getId()] = $transmissionTorrents->first();
            }
        }

        return $this->render('movies/list.html.twig', [
            'movies' => $movies,
            'torrents' => $torrents,
        ]);
    }

    /**
     * @Route("/movies/add/{tmdbId}", name="add_movie")
     */
    public function addMovie(int $tmdbId, MovieRepository $movieRepository): Response
    {
        $tmdbMovie = $this->tmdbClient->gETMovieMovieId($tmdbId);

        if (!$tmdbMovie) {
            return $this->createNotFoundException(sprintf('Movie #%s not found in TMDB', $tmdbId));
        }

        $movie = $movieRepository->findOneBy(['idTmdb' => $tmdbId]);

        if ($movie instanceof Movie) {
            $this->addFlash('info', 'alert.info.movie_exists');

            return $this->redirectToRoute('dashboard');
        } else {
            $movie = new Movie();
            $movie->setIdTmdb($tmdbMovie->getId())
                ->setTitle($tmdbMovie->getTitle())
                ->setStatus(ResourceStatus::MISSING);

            $this->getDoctrine()->getManager()->persist($movie);
        }

        $this->dispatchMessage(new DownloadMovieMessage($movie->getId()));

        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'alert.success.movie_added');

        return $this->redirectToRoute('dashboard');
    }
}

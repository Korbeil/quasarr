<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\TvShow;
use App\Repository\MovieRepository;
use App\Repository\TvShowRepository;
use App\TMDB\Authentication\ApiKeyAuthentication;
use App\TMDB\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $tmdbClient;

    public function __construct(string $tmdbApiKey)
    {
        $this->tmdbClient = Client::create(null, new ApiKeyAuthentication($tmdbApiKey));
    }

    /**
     * @Route("/", name="dashboard")
     */
    public function index(Request $request,
        MovieRepository $movieRepository,
        TvShowRepository $tvShowRepository): Response
    {
        if ($request->isMethod('POST')) {
            $search = $request->request->get('search');

            if (!$search) {
                return $this->redirectToRoute('dashboard');
            }

            $movies = $this->tmdbClient->gETSearchMovie(['query' => $search])->getResults();
            $tvShows = $this->tmdbClient->gETSearchTv(['query' => $search])->getResults();
        } else {
            $movies = $this->tmdbClient->gETMoviePopular()->getResults();
            $tvShows = $this->tmdbClient->gETTvPopular()->getResults();
        }

        $existingMovies = $movieRepository->findBy([
            'idTmdb' => array_map(function ($movie) {
                return $movie->getId();
            }, $movies),
        ]);
        $existingMovies = array_map(function (Movie $movie) {
            return $movie->getIdTmdb();
        }, $existingMovies);

        return $this->render('dashboard/index.html.twig', [
            'movies' => $movies ?? [],
            'tvShows' => $tvShows ?? [],
            'search' => $search ?? '',
            'existingMovies' => $existingMovies,
        ]);
    }
}

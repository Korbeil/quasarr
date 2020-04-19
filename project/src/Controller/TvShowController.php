<?php

namespace App\Controller;

use App\Entity\TvSeason;
use App\Entity\TvShow;
use App\Enum\ResourceStatus;
use App\Message\DownloadTvSeasonMessage;
use App\Repository\TvSeasonRepository;
use App\Repository\TvShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TMDB\API\Client;
use TMDB\API\Model\TvTvIdGetResponse200;
use Transmission\Client as TransmissionClient;

class TvShowController extends AbstractController
{
    private $tmdbClient;
    private $transmissionClient;

    public function __construct(Client $tmdbClient, TransmissionClient $transmissionClient)
    {
        $this->tmdbClient = $tmdbClient;
        $this->transmissionClient = $transmissionClient;
    }

    /**
     * @Route("/tvshows/seasons/{tmdbId}", name="get_tvshow_seasons")
     */
    public function getTvShowSeasons(int $tmdbId,
        TvShowRepository $tvShowRepository,
        TvSeasonRepository $tvSeasonRepository): Response
    {
        $tmdbTvShow = $this->tmdbClient->getTvShowDetails($tmdbId);
        if (!$tmdbTvShow instanceof TvTvIdGetResponse200) {
            throw $this->createNotFoundException(sprintf('TvShow #%s not found in TMDB', $tmdbId));
        }

        $tvShow = $tvShowRepository->findOneBy([
            'idTmdb' => $tmdbId,
        ]);
        $existingTvSeasons = [];

        foreach ($tmdbTvShow->getSeasons() as $season) {
            $tvSeason = $tvSeasonRepository->findOneBy([
                'tvShow' => $tvShow,
                'number' => $season->getSeasonNumber(),
            ]);

            if ($tvSeason instanceof TvSeason) {
                $existingTvSeasons[] = $tvSeason->getNumber();
            }
        }

        return $this->render('tv_shows/_modal_seasons.html.twig', [
            'tvShow' => $tmdbTvShow,
            'existingTvSeasons' => $existingTvSeasons,
        ]);
    }

    /**
     * @Route("/tvshows/season/add/{tmdbId}", name="add_tvseason")
     */
    public function addTvSeason(Request $request,
        int $tmdbId,
        TvShowRepository $tvShowRepository): Response
    {
        $tvShow = $tvShowRepository->findOneBy(['idTmdb' => $tmdbId]);

        if (!$tvShow instanceof TvShow) {
            $tmdbTvShow = $this->tmdbClient->gETTvTvId($tmdbId);

            $tvShow = new TvShow();
            $tvShow->setIdTmdb($tmdbTvShow->getId())
                ->setTitle($tmdbTvShow->getName())
                ->setStatus(ResourceStatus::MISSING);

            $this->getDoctrine()->getManager()->persist($tvShow);
            $this->getDoctrine()->getManager()->flush();
        }

        $seasonNumbers = $request->request->get('seasons-numbers');

        foreach ($seasonNumbers as $seasonNumber) {
            $tvSeason = new TvSeason();
            $tvSeason->setTvShow($tvShow)
                ->setNumber($seasonNumber)
                ->setStatus(ResourceStatus::MISSING);
            $this->getDoctrine()->getManager()->persist($tvSeason);

            $this->dispatchMessage(new DownloadTvSeasonMessage($seasonNumber, $tvShow->getId()));
        }

        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'alert.success.tvshow_added');

        return $this->redirectToRoute('dashboard');
    }
}

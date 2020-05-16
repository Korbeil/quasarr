<?php

namespace Quasarr\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Transmission\Client;
use Transmission\Models\Torrent;

class TorrentController extends AbstractController
{
    /**
     * @Route("/torrent/status/{hash}", name="torrent_status")
     */
    public function status(string $hash, Client $transmissionClient): JsonResponse
    {
        /** @var Torrent $transmissionTorrent */
        $transmissionTorrent = $transmissionClient->get($hash)->first();

        $data = [
            'status' => $transmissionTorrent->getStatusString(),
            'progress' => $transmissionTorrent->getPercentDone(true),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/torrent/resume/{hash}", name="torrent_resume")
     */
    public function resume(Client $transmissionClient, string $hash): JsonResponse
    {
        $isResumed = $transmissionClient->start($hash);

        return $this->json($isResumed);
    }

    /**
     * @Route("/torrent/pause/{hash}", name="torrent_pause")
     */
    public function pause(Client $transmissionClient, string $hash): JsonResponse
    {
        $isPaused = $transmissionClient->stop($hash);

        return $this->json($isPaused);
    }
}

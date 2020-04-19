<?php

namespace App\MessageHandler;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait BestResultTrait
{
    private function findBestTorrent(array $results)
    {
        $bestResult = [
            'score' => 0,
            'torrent' => null,
        ];

        foreach ($results as $result) {
            $score = 0;

            if ($result->Seeders >= 3 && $result->Seeders > $result->Peers) {
                ++$score;
            }

            if ($score > $bestResult['score']) {
                $bestResult = [
                    'score' => $score,
                    'torrent' => $result,
                ];
            }
            // check if match with settings
            // vostfr, quality wanted, max size
        }

        return $bestResult['torrent'];
    }
}

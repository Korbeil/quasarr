<?php

namespace Quasarr\MessageHandler;

use Quasarr\Entity\Torrent;

trait BestResultTrait
{
    private function findBestTorrent(array $results, string $type = Torrent::MOVIE_TYPE)
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

            if (Torrent::TVSEASON_TYPE === $type) {
                if (preg_match('/e\d+|episode|episode\d+|ep|ep\d+/', strtolower($result->Title))) {
                    // it's episode
                    continue;
                } else {
                    ++$score;
                }
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

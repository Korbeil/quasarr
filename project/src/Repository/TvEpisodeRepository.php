<?php

namespace Quasarr\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Quasarr\Entity\TvEpisode;

/**
 * @method TvEpisode|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvEpisode|null findOneBy(array $criteria, array $orderBy = null)
 * @method TvEpisode[]    findAll()
 * @method TvEpisode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvEpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvEpisode::class);
    }
}

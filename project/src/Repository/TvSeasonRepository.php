<?php

namespace Quasarr\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Quasarr\Entity\TvSeason;

/**
 * @method TvSeason|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvSeason|null findOneBy(array $criteria, array $orderBy = null)
 * @method TvSeason[]    findAll()
 * @method TvSeason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvSeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvSeason::class);
    }
}

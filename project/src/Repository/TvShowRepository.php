<?php

namespace Quasarr\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Quasarr\Entity\TvShow;

/**
 * @method TvShow|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvShow|null findOneBy(array $criteria, array $orderBy = null)
 * @method TvShow[]    findAll()
 * @method TvShow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvShowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvShow::class);
    }
}

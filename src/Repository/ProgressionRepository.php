<?php

namespace App\Repository;

use App\Entity\Progression;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Progression>
 */
class ProgressionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Progression::class);
    }


    public function userHasCompletedFirstChapters(User $user, int $count): bool
{
    return $this->createQueryBuilder('p')
        ->select('COUNT(p.id)')
        ->join('p.chapter', 'c')
        ->where('p.user = :user')
        ->andWhere('p.isCompleted = true')
        ->andWhere('c.order <= :count')
        ->setParameter('user', $user)
        ->setParameter('count', $count)
        ->getQuery()
        ->getSingleScalarResult() == $count;
}

    //    /**
    //     * @return Progression[] Returns an array of Progression objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Progression
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

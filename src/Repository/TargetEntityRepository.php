<?php

namespace App\Repository;

use App\Entity\TargetEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TargetEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TargetEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TargetEntity[]    findAll()
 * @method TargetEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TargetEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TargetEntity::class);
    }

    // /**
    //  * @return TargetEntity[] Returns an array of TargetEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TargetEntity
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

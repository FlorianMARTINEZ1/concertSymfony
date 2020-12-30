<?php

namespace App\Repository;

use App\Entity\ShowList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShowList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShowList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShowList[]    findAll()
 * @method ShowList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShowList::class);
    }

    // /**
    //  * @return ShowList[] Returns an array of ShowList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShowList
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

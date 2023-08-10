<?php

namespace App\Repository;

use App\Entity\CIE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CIE|null find($id, $lockMode = null, $lockVersion = null)
 * @method CIE|null findOneBy(array $criteria, array $orderBy = null)
 * @method CIE[]    findAll()
 * @method CIE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CIERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CIE::class);
    }

    // /**
    //  * @return CIE[] Returns an array of CIE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CIE
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

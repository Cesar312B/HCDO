<?php

namespace App\Repository;

use App\Entity\Nutricional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nutricional|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nutricional|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nutricional[]    findAll()
 * @method Nutricional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NutricionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nutricional::class);
    }

    // /**
    //  * @return Nutricional[] Returns an array of Nutricional objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nutricional
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

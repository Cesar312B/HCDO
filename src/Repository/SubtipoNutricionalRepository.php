<?php

namespace App\Repository;

use App\Entity\SubtipoNutricional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubtipoNutricional|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubtipoNutricional|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubtipoNutricional[]    findAll()
 * @method SubtipoNutricional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubtipoNutricionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubtipoNutricional::class);
    }

    // /**
    //  * @return SubtipoNutricional[] Returns an array of SubtipoNutricional objects
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
    public function findOneBySomeField($value): ?SubtipoNutricional
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

<?php

namespace App\Repository;

use App\Entity\AntReproductivos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AntReproductivos|null find($id, $lockMode = null, $lockVersion = null)
 * @method AntReproductivos|null findOneBy(array $criteria, array $orderBy = null)
 * @method AntReproductivos[]    findAll()
 * @method AntReproductivos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntReproductivosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AntReproductivos::class);
    }

    // /**
    //  * @return AntReproductivos[] Returns an array of AntReproductivos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AntReproductivos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

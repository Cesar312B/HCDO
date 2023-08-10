<?php

namespace App\Repository;

use App\Entity\AntQuirugicos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AntQuirugicos|null find($id, $lockMode = null, $lockVersion = null)
 * @method AntQuirugicos|null findOneBy(array $criteria, array $orderBy = null)
 * @method AntQuirugicos[]    findAll()
 * @method AntQuirugicos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntQuirugicosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AntQuirugicos::class);
    }

    // /**
    //  * @return AntQuirugicos[] Returns an array of AntQuirugicos objects
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
    public function findOneBySomeField($value): ?AntQuirugicos
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

<?php

namespace App\Repository;

use App\Entity\AntHeredofamiliares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AntHeredofamiliares|null find($id, $lockMode = null, $lockVersion = null)
 * @method AntHeredofamiliares|null findOneBy(array $criteria, array $orderBy = null)
 * @method AntHeredofamiliares[]    findAll()
 * @method AntHeredofamiliares[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntHeredofamiliaresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AntHeredofamiliares::class);
    }

    // /**
    //  * @return AntHeredofamiliares[] Returns an array of AntHeredofamiliares objects
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
    public function findOneBySomeField($value): ?AntHeredofamiliares
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

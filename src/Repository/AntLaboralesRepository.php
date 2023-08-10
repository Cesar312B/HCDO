<?php

namespace App\Repository;

use App\Entity\AntLaborales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AntLaborales|null find($id, $lockMode = null, $lockVersion = null)
 * @method AntLaborales|null findOneBy(array $criteria, array $orderBy = null)
 * @method AntLaborales[]    findAll()
 * @method AntLaborales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntLaboralesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AntLaborales::class);
    }

    // /**
    //  * @return AntLaborales[] Returns an array of AntLaborales objects
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
    public function findOneBySomeField($value): ?AntLaborales
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

<?php

namespace App\Repository;

use App\Entity\Unidadesoperativas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Unidadesoperativas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Unidadesoperativas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Unidadesoperativas[]    findAll()
 * @method Unidadesoperativas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnidadesoperativasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unidadesoperativas::class);
    }

    // /**
    //  * @return Unidadesoperativas[] Returns an array of Unidadesoperativas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Unidadesoperativas
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

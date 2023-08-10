<?php

namespace App\Repository;

use App\Entity\Examenes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Examenes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Examenes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Examenes[]    findAll()
 * @method Examenes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Examenes::class);
    }

    // /**
    //  * @return Examenes[] Returns an array of Examenes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Examenes
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

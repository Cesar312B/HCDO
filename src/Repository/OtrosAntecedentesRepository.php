<?php

namespace App\Repository;

use App\Entity\OtrosAntecedentes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OtrosAntecedentes|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtrosAntecedentes|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtrosAntecedentes[]    findAll()
 * @method OtrosAntecedentes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtrosAntecedentesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtrosAntecedentes::class);
    }

    // /**
    //  * @return OtrosAntecedentes[] Returns an array of OtrosAntecedentes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OtrosAntecedentes
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

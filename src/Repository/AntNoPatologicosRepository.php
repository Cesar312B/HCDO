<?php

namespace App\Repository;

use App\Entity\AntNoPatologicos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AntNoPatologicos|null find($id, $lockMode = null, $lockVersion = null)
 * @method AntNoPatologicos|null findOneBy(array $criteria, array $orderBy = null)
 * @method AntNoPatologicos[]    findAll()
 * @method AntNoPatologicos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntNoPatologicosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AntNoPatologicos::class);
    }

    // /**
    //  * @return AntNoPatologicos[] Returns an array of AntNoPatologicos objects
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
    public function findOneBySomeField($value): ?AntNoPatologicos
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

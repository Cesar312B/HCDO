<?php

namespace App\Repository;

use App\Entity\Actividades;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actividades|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actividades|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actividades[]    findAll()
 * @method Actividades[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActividadesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actividades::class);
    }




    

    public function actividad_puesto($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('c.id','c.actividad','c.riesgos')
        ->from('App:actividades','c')
        ->innerJoin('App:puestotrabajo','p',\Doctrine\ORM\Query\Expr\Join::WITH,'p=c.puesto_trabajo')
        ->where('p.id=:user_id')
        ->setParameter('user_id',$id_user)
        ;
        dump($q->getQuery()->getResult());
      return $q->getQuery()->getResult();
    }


    // /**
    //  * @return Actividades[] Returns an array of Actividades objects
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
    public function findOneBySomeField($value): ?Actividades
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

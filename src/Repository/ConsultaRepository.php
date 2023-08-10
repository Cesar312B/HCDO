<?php

namespace App\Repository;

use App\Entity\Consulta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Consulta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consulta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consulta[]    findAll()
 * @method Consulta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsultaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consulta::class);
    }

    public function consulta_examene($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('s.id','s.nombre_examen','s.fecha_examen','s.resultado_examen','s.Observaciones')
        ->from('App:consulta','p')
        ->innerJoin('App:examenes','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.consulta')
        ->where('p.id=:user_id')
        ->setParameter('user_id',$id_user);
        
      
      return $q->getQuery()->getResult();
      }

      public function consulta_examene_full($id_user,$consulta,$fecha_consulta){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('s.id','s.nombre_examen','s.fecha_examen','s.resultado_examen','s.Observaciones','p.motivo_consulta','p.fecha_atencion')
        ->from('App:consulta','p')
        ->innerJoin('App:examenes','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.consulta')
        ->innerJoin('App:pacientes','m',\Doctrine\ORM\Query\Expr\Join::WITH,'m=p.pacientes')
        ->where('m.id=:user_id')
        ->andWhere('p.id != :consulta_id')
        ->andWhere('p.fecha_atencion < :fecha_consulta')
        ->setParameter('user_id',$id_user)
        ->setParameter('consulta_id',$consulta)
        ->setParameter('fecha_consulta',$fecha_consulta);
        
        
      
      return $q->getQuery()->getResult();
      }


      
    public function consulta_nutricional($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('s.id','s.descripcion_hab','y.tipo','x.sub_tipo')
        ->from('App:consulta','p')
        ->innerJoin('App:nutricional','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.consulta')
        ->innerJoin('App:subtiponutricional','x',\Doctrine\ORM\Query\Expr\Join::WITH,'x=s.suptipo_nutricional')
        ->innerJoin('App:tiponutricional','y',\Doctrine\ORM\Query\Expr\Join::WITH,'y=x.tipo_nutricional')
        ->where('p.id=:user_id')
        ->setParameter('user_id',$id_user);
      return $q->getQuery()->getResult();
      }

      public function consulta_nutricional_full($id_user,$consulta,$fecha_consulta){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('s.id','s.descripcion_hab','y.tipo','x.sub_tipo','p.motivo_consulta','p.fecha_atencion')
        ->from('App:consulta','p')
        ->innerJoin('App:nutricional','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.consulta')
        ->innerJoin('App:pacientes','m',\Doctrine\ORM\Query\Expr\Join::WITH,'m=p.pacientes')
        ->innerJoin('App:subtiponutricional','x',\Doctrine\ORM\Query\Expr\Join::WITH,'x=s.suptipo_nutricional')
        ->innerJoin('App:tiponutricional','y',\Doctrine\ORM\Query\Expr\Join::WITH,'y=x.tipo_nutricional')
        ->where('m.id=:user_id')
        ->andWhere('p.id != :consulta_id')
        ->andWhere('p.fecha_atencion < :fecha_consulta')
        ->setParameter('user_id',$id_user)
        ->setParameter('consulta_id',$consulta)
        ->setParameter('fecha_consulta',$fecha_consulta);

      return $q->getQuery()->getResult();
      }


      public function consulta_examenef($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('s.id','s.piel','s.ojos','s.oido','s.oro_farinje','s.nariz','s.cuello','s.torax1','s.columna','s.pelvis','s.extremidades','s.neurologico','s.observaciones','s.abdomen','s.oro_farinje')
        ->from('App:consulta','p')
        ->innerJoin('App:examenfisico','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.consulta')
        ->where('p.id=:user_id')
        ->setParameter('user_id',$id_user);
        
      
      return $q->getQuery()->getResult();
      }


      public function consulta_examenefull($id_user,$consulta,$fecha_consulta){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('s.id','s.piel','s.ojos','s.oido','s.oro_farinje','s.nariz','s.cuello','s.torax1','s.columna','s.pelvis','s.extremidades','s.neurologico','s.observaciones','s.abdomen','s.oro_farinje,p.motivo_consulta,p.fecha_atencion')
        ->from('App:consulta','p')
        ->innerJoin('App:examenfisico','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.consulta')
        ->innerJoin('App:pacientes','m',\Doctrine\ORM\Query\Expr\Join::WITH,'m=p.pacientes')
        ->where('m.id=:user_id')
        ->andWhere('p.id != :consulta_id')
        ->andWhere('p.fecha_atencion < :fecha_consulta')
        ->setParameter('user_id',$id_user)
        ->setParameter('consulta_id',$consulta)
        ->setParameter('fecha_consulta',$fecha_consulta);
      
      return $q->getQuery()->getResult();
      }

   

   
  

    // /**
    //  * @return Consulta[] Returns an array of Consulta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consulta
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

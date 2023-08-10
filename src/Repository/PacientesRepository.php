<?php

namespace App\Repository;

use App\Entity\Pacientes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pacientes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pacientes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pacientes[]    findAll()
 * @method Pacientes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PacientesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pacientes::class);
    }




    public function consulta_paciente($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('c.id','s.id AS SI','p.id AS PI','c.motivo_consulta','c.descripcion','c.fecha_atencion','ep.Nombre','ep.Apellido','ep.Profesion','u.nombre',
        's.estatura','s.peso','s.temperatura','s.frecuencia_respiratoria','s.sistole','s.diastole','s.frecuencia_cardiaca','s.grasa_corporal','s.masa_muscular',
        's.saturacion_oxigeno','s.grasa_visceral','s.hidratacion','s.cintura','s.glucosa_ayunas','s.glucosa_post'
        )
        ->from('App:pacientes','p')
        ->innerJoin('App:consulta','c',\Doctrine\ORM\Query\Expr\Join::WITH,'p=c.pacientes' )
        ->innerJoin('App:employed','ep',\Doctrine\ORM\Query\Expr\Join::WITH,'ep=c.employed' )
        ->innerJoin('App:unidadesoperativas','u',\Doctrine\ORM\Query\Expr\Join::WITH,'u=ep.unidadesoperativas' )
        ->innerJoin('App:signosvitales','s',\Doctrine\ORM\Query\Expr\Join::WITH,'s=c.signos_vitales')
 
        ->where('p.id=:user_id')
        ->setParameter('user_id',$id_user)
        ->orderBy('c.fecha_atencion', 'DESC')
        ;
 
      return $q->getQuery()->getResult();
    }


    
    public function pacientes_doctor($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('c.id','s.id AS SI','x.id AS XI','p.id AS PI','c.motivo_consulta','c.fecha_atencion','p.cedula','p.image','p.pnombre','p.snombre','p.papellido','p.sapellido','u.nombre','s.estatura','s.peso','s.temperatura','s.frecuencia_respiratoria','s.sistole','s.diastole','s.frecuencia_cardiaca','s.grasa_corporal','s.masa_muscular','s.saturacion_oxigeno','s.grasa_visceral','s.hidratacion','x.piel',
        'x.ojos','x.oido','x.oro_farinje','x.nariz','x.cuello','x.torax1','x.columna','x.pelvis','x.extremidades','x.neurologico','x.observaciones','x.abdomen'
        )
        ->from('App:pacientes','p')
        ->innerJoin('App:consulta','c',\Doctrine\ORM\Query\Expr\Join::WITH,'p=c.pacientes' )
        ->innerJoin('App:employed','ep',\Doctrine\ORM\Query\Expr\Join::WITH,'ep=c.employed' )
        ->innerJoin('App:unidadesoperativas','u',\Doctrine\ORM\Query\Expr\Join::WITH,'u=ep.unidadesoperativas' )
        ->innerJoin('App:signosvitales','s',\Doctrine\ORM\Query\Expr\Join::WITH,'s=c.signos_vitales')
        ->innerJoin('App:examenfisico','x',\Doctrine\ORM\Query\Expr\Join::WITH,'x=c.examen_fisico')
        ->where('ep.id=:user_id')
        ->setParameter('user_id',$id_user)
        ->orderBy('c.fecha_atencion', 'ASC');
        ;
    
      return $q->getQuery()->getResult();
    }



    public function paciennte_antNopatologicos($id_user){

  
        $q= $this->getEntityManager()->createQueryBuilder();
        
        $q->select('p.id AS PI,s.id','s.actividad_fisica','s.numero_actividad_fisica','s.uso_sustancias','s.numero_sustancias','s.ex_consumidor',
        's.medicacion_abitual','s.cantdad_medicacion','s.tabaco','s.tiempo_consumo','s.cantidad','s.exconsumidor','s.tiempo_abstinencia',
        's.tiempo_consumo_a','s.cantidad_a','s.exconsumidor_a','s.tiempo_abstinencia_a','s.tiempo_consumo_d','s.tiempo_abstinencia_d',
        's.deporte_select','s.sustancia_selec','s.medicamento_select','s.droga_descripcion')
        ->from('App:pacientes','p')
        ->innerJoin('App:antnopatologicos','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
        ->where('p.id=:user_id')
        ->setParameter('user_id',$id_user)
        ;
    
      return $q->getQuery()->getResult();
    }



    


    
    public function paciennte_antPatologicos($id_user){

  
      $q= $this->getEntityManager()->createQueryBuilder();
      
      $q->select('s.id','p.id AS PI','s.piel_anexos','s.organos_sentidos','s.respiratorio','s.cardiovascular','s.digestivo','s.genito_urinario',
      's.musculo_esqueletico', 's.endocrino','s.hemolinfatico','s.nervioso',
      's.enfermedad_actual','s.observaciones')
      ->from('App:pacientes','p')
      ->innerJoin('App:antpatologicos','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
      ->where('p.id=:user_id')
      ->setParameter('user_id',$id_user)
      ;
  
    return $q->getQuery()->getResult();
  }




  
  public function paciennte_antReproductivos($id_user){

  
    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('s.id','p.id AS PI','s.menarquia','s.ciclos','s.gestas','s.partos','s.abortos','s.hijos','s.cesareas','s.vida_sexual',
    's.ultima_menstruacion','s.ultima_mastografia','s.tiempo_mastografia','s.resultado_mastografia','s.colposcopia','s.tiempo_colposcopia','s.resultado_colposcopia',
    's.metodo_planificacion','s.papanicolaou','s.tiempo_papanicolaou','s.resultado_papanicolaou','s.eco_mamario','s.tiempo_ecomamario',
    's.resultado_ecomamario','s.antigeno_prostatico','s.tiempo_antigenoprostatico','s.resultado_antigenoprostatico','s.eco_prostatico',
    's.tiempo_ecoprostatico','s.resultado_ecoprostatico')
    ->from('App:pacientes','p')
    ->innerJoin('App:antreproductivos','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
    ->where('p.id=:user_id')
    ->setParameter('user_id',$id_user)
    ;
  
  return $q->getQuery()->getResult();
}


  
public function paciennte_OtrosAntecedentes($id_user){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','p.id AS PI','s.alergias','s.fecha_vacuna','v.Nombre AS vacuna','v.Dosis','s.n_dosis')
  ->from('App:pacientes','p')
  ->innerJoin('App:otrosantecedentes','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->leftJoin('App:vacunas','v',\Doctrine\ORM\Query\Expr\Join::WITH,'v=s.vacunas')
  ->where('p.id=:user_id')
  ->setParameter('user_id',$id_user)
  ;

return $q->getQuery()->getResult();
}



  
public function paciente_AntFamiliares($id_user){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','p.id AS PI','s.Patologia','s.Parentesco','s.descripcion')
  ->from('App:pacientes','p')
  ->innerJoin('App:antheredofamiliares','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->where('p.id=:user_id')
  ->setParameter('user_id',$id_user)
  ;
 
return $q->getQuery()->getResult();
}


  
public function paciente_AntQuirugicos($id_user){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','p.id AS PI','s.procedimiento','s.tiempo','s.complicaciones','s.ant_clinico','s.tratamiento')
  ->from('App:pacientes','p')
  ->innerJoin('App:antquirugicos','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->where('p.id=:user_id')
  ->setParameter('user_id',$id_user);

return $q->getQuery()->getResult();
}


  
public function paciente_AntLaborales($id_user){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','p.id AS PI','s.empresa','s.puesto_trabajo','s.actividades','s.tiempo_trabajo','s.riesgo','s.observaciones','s.ac_trabajo','s.enferemedad','s.ob_enfermedades','s.act_extra','s.descripcion_accidentes','s.descripcion_emfermedad','s.fecha_accidente','s.fecha_enfermedad')
  ->from('App:pacientes','p')
  ->innerJoin('App:antlaborales','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->where('p.id=:user_id')
  ->setParameter('user_id',$id_user)
  ;

return $q->getQuery()->getResult();
}






  
public function paciennte_Diagnostico($id_user,$consulta_id){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','p.id AS PI','t.id AS TI','s.tipo_diagnostico','s.solicitud',
  'm.descripcion','m.tipo','m.codigo','t.dosis','t.frecuencia','t.duracion','t.indicaciones','v.descripcion AS medicamento','c.id AS CI','t.presentacion','t.cantidad')
  ->from('App:pacientes','p')
  ->innerJoin('App:diagnostico','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->innerJoin('App:consulta','c',\Doctrine\ORM\Query\Expr\Join::WITH,'c=s.consulta')
  ->leftJoin('App:tratamiento','t',\Doctrine\ORM\Query\Expr\Join::WITH,'s=t.diagnostico')
  ->innerJoin('App:cie','m',\Doctrine\ORM\Query\Expr\Join::WITH,'m=s.cie')
  ->leftJoin('App:medicamentos','v',\Doctrine\ORM\Query\Expr\Join::WITH,'v=t.medicamentos') 
  ->where('p.id=:user_id')
  ->andWhere('c.id=:consulta_id')
  ->setParameter('user_id',$id_user)
  ->setParameter('consulta_id',$consulta_id)
  ;

return $q->getQuery()->getResult();
}



public function paciennte_Diagnostico_full($id_user,$consulta,$fecha_consulta){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','p.id AS PI','t.id AS TI','s.tipo_diagnostico','s.solicitud',
  'm.descripcion','m.tipo','m.codigo','t.dosis','t.frecuencia','t.duracion','t.indicaciones','v.descripcion AS medicamento','c.id AS CI','c.motivo_consulta','c.fecha_atencion','t.presentacion','t.cantidad')
  ->from('App:pacientes','p')
  ->innerJoin('App:diagnostico','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->innerJoin('App:consulta','c',\Doctrine\ORM\Query\Expr\Join::WITH,'c=s.consulta')
  ->leftJoin('App:tratamiento','t',\Doctrine\ORM\Query\Expr\Join::WITH,'s=t.diagnostico')
  ->innerJoin('App:cie','m',\Doctrine\ORM\Query\Expr\Join::WITH,'m=s.cie')
  ->leftJoin('App:medicamentos','v',\Doctrine\ORM\Query\Expr\Join::WITH,'v=t.medicamentos') 
  ->where('p.id=:user_id')
  ->andWhere('c.id != :consulta_id')
  ->andWhere('c.fecha_atencion < :fecha_consulta')
  ->setParameter('user_id',$id_user)
  ->setParameter('consulta_id',$consulta)
  ->setParameter('fecha_consulta',$fecha_consulta)
  ;

return $q->getQuery()->getResult();
}

  
public function paciennte_Diagnostico2($id_user,$consulta_id){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','s.tipo_diagnostico','s.solicitud',
  'm.descripcion','m.tipo','m.codigo','c.motivo_consulta','c.fecha_atencion')
  ->from('App:pacientes','p')
  ->innerJoin('App:diagnostico','s',\Doctrine\ORM\Query\Expr\Join::WITH,'p=s.pacientes')
  ->innerJoin('App:consulta','c',\Doctrine\ORM\Query\Expr\Join::WITH,'c=s.consulta')
  ->innerJoin('App:cie','m',\Doctrine\ORM\Query\Expr\Join::WITH,'m=s.cie')
  ->where('p.id=:user_id')
  ->andWhere('c.id=:consulta_id')
  ->setParameter('user_id',$id_user)
  ->setParameter('consulta_id',$consulta_id)
  ;

return $q->getQuery()->getResult();
}





  
public function paciente_puestotrabajo ($id_user){

  
  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('s.id','a.actividad','a.riesgos')
  ->from('App:pacientes','p')
  ->innerJoin('App:puestotrabajo','s',\Doctrine\ORM\Query\Expr\Join::WITH,'s=p.puesto_trabajo')
  ->innerJoin('App:actividades','a',\Doctrine\ORM\Query\Expr\Join::WITH,'s=a.puesto_trabajo')
  ->where('p.id=:user_id')
  ->setParameter('user_id',$id_user)
  ;
 
return $q->getQuery()->getResult();
}













    // /**
    //  * @return Pacientes[] Returns an array of Pacientes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pacientes
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

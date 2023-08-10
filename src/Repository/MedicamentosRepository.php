<?php

namespace App\Repository;

use App\Entity\Medicamentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medicamentos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicamentos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicamentos[]    findAll()
 * @method Medicamentos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicamentosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medicamentos::class);
    }

    // /**
    //  * @return Medicamentos[] Returns an array of Medicamentos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medicamentos
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function medicamentos2()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT MAX(s.year) AS max_year FROM medicamentos s";
        $stmt = $conn->executeQuery($sql);
        $result = $stmt->fetch();
    
        $maxYear = $result['max_year'];
    
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.year = :identifier');
        $qb->setParameter('identifier', $maxYear);
    
    }

    public function medicamentos()
    {
       /*$conn = $this->getEntityManager()
        ->getConnection();
        $sql = "SELECT MAX(s.year) FROM medicamentos s";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $at=dump($stmt->fetchAll());*/

        return $this->createQueryBuilder('u')
        ->select('u.id','u.codigo','u.descripcion','u.principio_activo','u.laboratorio','u.fraccion','u.Clasificacion','u.Marca','u.estado_producto','u.presentacion_producto','u.mercado','u.iva',
        'u.generico','u.portafolio_cat','u.observaciones','u.year')
        ->getQuery()
        ->getResult()
        ;
    }
}

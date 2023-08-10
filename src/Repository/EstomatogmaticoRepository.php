<?php

namespace App\Repository;

use App\Entity\Estomatogmatico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estomatogmatico>
 *
 * @method Estomatogmatico|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estomatogmatico|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estomatogmatico[]    findAll()
 * @method Estomatogmatico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstomatogmaticoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estomatogmatico::class);
    }

    public function add(Estomatogmatico $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Estomatogmatico $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Estomatogmatico[] Returns an array of Estomatogmatico objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Estomatogmatico
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

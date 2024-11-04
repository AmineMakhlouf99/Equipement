<?php

namespace App\Repository;

use App\Entity\PvAffectation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PvAffectation>
 */
class PvAffectationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PvAffectation::class);
    }

//    /**
//     * @return PvAffectation[] Returns an array of PvAffectation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PvAffectation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function findAllWithDetails(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.materiel', 'm')
            ->addselect('m')
            ->leftJoin('p.collaborateur', 'c')
            ->addselect('c')
            ->leftJoin('p.fournisseur', 'f')
            ->addselect('f')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }
    public function findAllWithDetailsCollab(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.materiel', 'm')
            ->addselect('m')
            ->leftJoin('p.collaborateur', 'c')
            ->addselect('c')
            ->andWhere('c.id IS NOT NULL')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }
    public function findAllWithDetailsFour(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.materiel', 'm')
            ->addselect('m')
            ->leftJoin('p.fournisseur', 'f')
            ->addselect('f')
            ->andWhere('f.id IS NOT NULL')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }    
}

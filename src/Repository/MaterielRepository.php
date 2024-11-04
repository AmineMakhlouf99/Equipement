<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Materiel>
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

//    /**
//     * @return Materiel[] Returns an array of Materiel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Materiel
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function findByEtatAndDisponibilite($etat, $disponibilite){
    return $this->createQueryBuilder('m')
                ->select('m.id,m.nom, m.numero_serie')
                ->andWhere('m.etat = :val1')
                ->andWhere('m.disponibilite = :val2')
                ->setParameter('val1', $etat)
                ->setParameter('val2', $disponibilite)
                ->orderBy('m.id', 'ASC')
                ->getQuery()
                ->getResult()        
    ;


}
public function findByDisponibilite($disponibilite){
    return $this->createQueryBuilder('m')
                 ->select('m')
                 ->where('m.disponibilite = :val')
                 ->setParameter('val', $disponibilite)
                 ->orderBy('m.id', 'ASC')
                 ->getQuery()
                 ->getResult()        
     ;
}
public function findByDisponibiliteOr($disponibilite1, $disponibilite2){
    return $this->createQueryBuilder('m')
                 ->select('m')
                 ->where('m.disponibilite = :val1')
                 ->orWhere('m.disponibilite = :val2')
                 ->setParameter('val1', $disponibilite1)
                 ->setParameter('val2', $disponibilite2)
                 ->orderBy('m.id', 'ASC')
                 ->getQuery()
                 ->getResult()        
     ;
}
public function CountMateriel()
    {
        return (int) $this->createQueryBuilder('m')
        ->select('COUNT(m.id)')
        ->getQuery()
        ->getSingleScalarResult()
        ;
    }   
public function CountMaterielBydispo($disponibilite)
    {
        return (int) $this->createQueryBuilder('m')
        ->select('COUNT(m.id)')
        ->andWHere('m.disponibilite=:val')
        ->setParameter('val',$disponibilite)
        ->getQuery()
        ->getSingleScalarResult()
        ;
    }   
public function CountMaterielByEtat($etat)
    {
        return (int) $this->createQueryBuilder('m')
        ->select('COUNT(m.id)')
        ->andWHere('m.etat=:val')
        ->setParameter('val',$etat)
        ->getQuery()
        ->getSingleScalarResult()
        ;
    }   
}
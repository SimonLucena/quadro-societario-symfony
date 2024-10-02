<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Socio>
 */
class SocioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socio::class);
    }

    public function create(Socio $socio): void
    {
        $em = $this->getEntityManager();
        $em->persist($socio);
        $em->flush();
    }

    public function read(Socio $socio)
    {

    }

    public function update(Socio $socio): void
    {
        $em = $this->getEntityManager();
        $em->persist($socio);
        $em->flush();
    }

    public function delete(Socio $socio): void
    {
        $em = $this->getEntityManager();
        $em->remove($socio);
        $em->flush();
    }

//    /**
//     * @return Socio[] Returns an array of Socio objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Socio
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

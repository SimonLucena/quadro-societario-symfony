<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function getSocioByEmpresa(string $empresa): array
    {
        return $this->findBy(['codigoid_empresa' => $empresa]);
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
}

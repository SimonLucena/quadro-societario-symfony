<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }

    public function create(Empresa $empresa): void
    {
        $em = $this->getEntityManager();
        $em->persist($empresa);
        $em->flush();
    }

    public function getCodigoidByCnpj(string $cnpj): ?Empresa
    {
        return $this->findOneBy(['cnpj' => $cnpj]);
    }

    public function getEmpresa(string $codigoid): ?Empresa
    {
        return $this->findOneBy(['codigoid' => $codigoid]);
    }

    public function update(Empresa $empresa): void
    {
        $em = $this->getEntityManager();
        $em->flush();
    }

    public function delete(Empresa $empresa): void
    {
        $em = $this->getEntityManager();
        $em->remove($empresa);
        $em->flush();
    }

}
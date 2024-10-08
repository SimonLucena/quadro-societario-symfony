<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private string $codigoid;

    #[ORM\Column(length: 255)]
    private string $cnpj;

    #[ORM\Column(length: 255)]
    private string $razao_social;

    public function getCodigoid(): string
    {
        return $this->codigoid;
    }

    public function setCodigoid(): static
    {
        $this->codigoid = Uuid::v4()->toRfc4122();

        return $this;
    }

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): static
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getRazaoSocial(): string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(string $razao_social): static
    {
        $this->razao_social = $razao_social;

        return $this;
    }
}
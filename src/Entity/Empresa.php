<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $codigoid = null;

    #[ORM\Column(length: 255)]
    private ?string $cnpj = null;

    #[ORM\Column(length: 255)]
    private ?string $razao_social = null;

    public function getCodigoid(): ?string
    {
        return $this->codigoid;
    }

    public function setCodigoid(string $codigoid): static
    {
        $this->codigoid = $codigoid;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): static
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(string $razao_social): static
    {
        $this->razao_social = $razao_social;

        return $this;
    }
}
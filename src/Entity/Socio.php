<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
class Socio
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $codigoid = null;

    #[ORM\Column(length: 255)]
    private ?string $cnpj_cpf = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $codigoid_empresa = null;

    #[ORM\Column]
    private ?float $participacao = null;

    public function getCodigoid(): ?string
    {
        return $this->codigoid;
    }

    public function setCodigoid(string $codigoid): static
    {
        $this->codigoid = $codigoid;

        return $this;
    }

    public function getCnpjCpf(): ?string
    {
        return $this->cnpj_cpf;
    }

    public function setCnpjCpf(string $cnpj_cpf): static
    {
        $this->cnpj_cpf = $cnpj_cpf;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCodigoidEmpresa(): ?string
    {
        return $this->codigoid_empresa;
    }

    public function setCodigoidEmpresa(string $codigoid_empresa): static
    {
        $this->codigoid_empresa = $codigoid_empresa;

        return $this;
    }

    public function getParticipacao(): ?float
    {
        return $this->participacao;
    }

    public function setParticipacao(float $participacao): static
    {
        $this->participacao = $participacao;

        return $this;
    }
}

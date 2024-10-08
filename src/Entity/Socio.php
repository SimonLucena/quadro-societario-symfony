<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
class Socio
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private string $codigoid;

    #[ORM\ManyToOne(targetEntity: Empresa::class, inversedBy: 'codigoid_empresa')]
    #[ORM\JoinColumn(name: "codigoid_empresa", referencedColumnName: "codigoid", nullable: false)]
    private Empresa $codigoid_empresa;

    #[ORM\Column(length: 255)]
    private string $cnpj_cpf;

    #[ORM\Column(length: 255)]
    private string $nome;

    #[ORM\Column]
    private ?float $participacao = null;

    public function getCodigoid(): ?string
    {
        return $this->codigoid;
    }

    public function setCodigoid(): static
    {
        $this->codigoid = Uuid::v4()->toRfc4122();

        return $this;
    }

    public function getCnpjCpf(): string
    {
        return $this->cnpj_cpf;
    }

    public function setCnpjCpf(string $cnpj_cpf): static
    {
        $this->cnpj_cpf = $cnpj_cpf;

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCodigoidEmpresa(): Empresa
    {
        return $this->codigoid_empresa;
    }

    public function setCodigoidEmpresa(Empresa $codigoid_empresa): static
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

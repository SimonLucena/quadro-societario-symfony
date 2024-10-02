<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Socio;
use App\Repository\SocioRepository;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SocioController extends AbstractController
{
    private SocioRepository $socioRepository;
    private EmpresaRepository $empresaRepository;
    public function __construct(SocioRepository $socioRepository, EmpresaRepository $empresaRepository)
    {
        $this->socioRepository = $socioRepository;
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * @Route('/socio', methods={"POST"})
     */

    public function addSocio(): JsonResponse
    {
        $request = Request::createFromGlobals();
        $content = $request->toArray();

        // Busca a empresa pelo CNPJ fornecido
        $empresa = $this->empresaRepository->getCodigoidByCnpj($content["empresa"]);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        $socio = new Socio();

        $socio->setCodigoid();
        $socio->setNome($content["nome"]);
        $socio->setCnpjCpf($content["cnpj_cpf"]);
        $socio->setParticipacao($content["participacao"]);
        $socio->setCodigoidEmpresa($empresa);

        $this->socioRepository->create($socio);

        return $this->json(
            'success '.$socio->getCodigoid(),
        );
    }
}

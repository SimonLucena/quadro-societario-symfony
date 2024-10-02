<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmpresaController extends AbstractController
{
    private EmpresaRepository $empresaRepository;
    public function __construct(EmpresaRepository $empresaRepository)
    {
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * @Route("/empresa", methods={"POST"})
     */

    public function addEmpresa(): JsonResponse
    {
        $request = Request::createFromGlobals();
        $content = $request->toArray();

        $empresa = new Empresa();

        $empresa->setCodigoid();
        $empresa->setCnpj($content["cnpj"]);
        $empresa->setRazaoSocial($content["razao_social"]);

        $this->empresaRepository->create($empresa);

        return $this->json(
            'success '.$empresa->getCodigoid(),
        );
    }

    public function getEmpresa(string $cnpj): JsonResponse
    {
        $empresa = $this->empresaRepository->getCodigoidByCnpj($cnpj);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        return $this->json([
            'codigoid' => $empresa->getCodigoid(),
        ]);
    }
}

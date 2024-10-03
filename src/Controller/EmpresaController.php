<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use App\Repository\SocioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmpresaController extends AbstractController
{
    private EmpresaRepository $empresaRepository;
    private SocioRepository $socioRepository;

    public function __construct(EmpresaRepository $empresaRepository, SocioRepository $socioRepository)
    {
        $this->empresaRepository = $empresaRepository;
        $this->socioRepository = $socioRepository;
    }

    /**
     * @Route("/empresa", methods={"GET"})
     */
    public function listarEmpresas(): JsonResponse
    {
        $empresas = $this->empresaRepository->findAll();
        $responseData = [];

        foreach ($empresas as $empresa) {
            $responseData[] = [
                'codigoid' => $empresa->getCodigoid(),
                'cnpj' => $empresa->getCnpj(),
                'razao_social' => $empresa->getRazaoSocial(),
            ];
        }

        return $this->json($responseData);
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

    /**
     * @Route("/empresa/{cnpj}", methods={"GET"}, requirements={"cnpj"="\d+"})
     */
    public function getEmpresaByCnpj(string $cnpj): JsonResponse
    {
        $empresa = $this->empresaRepository->getCodigoidByCnpj($cnpj);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        return $this->json($empresa);
    }

    /**
     * @Route("/empresa/{codigoid}", methods={"GET"}, requirements={"codigoid"="^[0-9a-fA-F\-]{36}$"})
     */
    public function getEmpresa(string $codigoid): JsonResponse
    {
        $empresa = $this->empresaRepository->getEmpresa($codigoid);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        // Usando colchetes para construir o array de resposta corretamente
        $responseData = [
            'codigoid' => $empresa->getCodigoid(),
            'cnpj' => $empresa->getCnpj(),
            'razao_social' => $empresa->getRazaoSocial(),
        ];

        return $this->json($responseData);
    }


    /**
     * @Route("/empresa/{codigoid}", methods={"PUT"})
     */
    public function atualizarEmpresa(string $codigoid, Request $request): JsonResponse
    {
        $data = $request->toArray();

        $empresa = $this->empresaRepository->find($codigoid);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        $empresa->setCnpj($data['cnpj']);
        $empresa->setRazaoSocial($data['razao_social']);

        $this->empresaRepository->update($empresa);

        return $this->json(['message' => 'Empresa atualizada com sucesso']);
    }

    /**
     * @Route("/empresa/{codigoid}", methods={"DELETE"})
     */
    public function excluirEmpresa(string $codigoid): JsonResponse
    {
        // Busca a empresa pelo codigoid
        $empresa = $this->empresaRepository->find($codigoid);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        // Busca todos os sócios associados à empresa
        $socios = $this->socioRepository->findBy(['codigoid_empresa' => $codigoid]);

        // Remove os sócios associados
        foreach ($socios as $socio) {
            $this->socioRepository->delete($socio);
        }

        // Remove a empresa
        $this->empresaRepository->delete($empresa);

        return $this->json(['message' => 'Empresa e sócios excluídos com sucesso']);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Socio;
use App\Repository\SocioRepository;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/socio/empresa/{codigoid}", methods={"GET"})
     */
    public function getSocios(string $codigoid): JsonResponse
    {
        $socios = $this->socioRepository->getSocioByEmpresa($codigoid);

        if (!$socios) {
            return $this->json(['error' => 'Nenhum sócio encontrado para essa empresa'], 404);
        }

        foreach ($socios as $socio) {
            $responseData[] = [
                'codigoid' => $socio->getCodigoid(),
                'nome' => $socio->getNome(),
                'cnpj_cpf' => $socio->getCnpjCpf(),
                'participacao' => $socio->getParticipacao(),
            ];
        }

        return $this->json($responseData);
    }

    /**
     * @Route("/socio", methods={"POST"})
     */
    public function addSocio(): JsonResponse
    {
        $request = Request::createFromGlobals();
        $content = $request->toArray();

        // Busca a empresa pelo codigoid_empresa fornecido
        $empresa = $this->empresaRepository->find($content["codigoid_empresa"]);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        $socio = new Socio();
        $socio->setCodigoid();
        $socio->setNome($content["nome"]);
        $socio->setCnpjCpf($content["cnpj_cpf"]);
        $socio->setParticipacao($content["participacao"]);

        // Define o objeto Empresa no Sócio
        $socio->setCodigoidEmpresa($empresa);

        $this->socioRepository->create($socio);

        return $this->json('success ' . $socio->getCodigoid());
    }

    /**
     * @Route("/socio/{cnpjCpf}", methods={"GET"})
     */
    public function getSocio(string $cnpjCpf): JsonResponse
    {
        $socio = $this->socioRepository->findOneBy(['cnpj_cpf' => $cnpjCpf]);

        if (!$socio) {
            return $this->json(['error' => 'Sócio não encontrado'], 404);
        }

        $responseData = [
            'codigoid' => $socio->getCodigoid(),
            'nome' => $socio->getNome(),
            'cnpj_cpf' => $socio->getCnpjCpf(),
            'participacao' => $socio->getParticipacao(),
            'empresa' => $socio->getCodigoidEmpresa()->getRazaoSocial(),
        ];

        return $this->json($responseData);
    }

    /**
     * @Route("/socio/{id}", methods={"PUT"})
     */
    public function atualizarSocio(string $id, Request $request): JsonResponse
    {
        $content = $request->toArray();
        $socio = $this->socioRepository->find($id);

        if (!$socio) {
            return $this->json(['error' => 'Sócio não encontrado'], 404);
        }

        $empresa = $this->empresaRepository->getCodigoidByCnpj($content["empresa"]);

        if (!$empresa) {
            return $this->json(['error' => 'Empresa não encontrada'], 404);
        }

        $socio->setNome($content["nome"]);
        $socio->setCnpjCpf($content["cnpj_cpf"]);
        $socio->setParticipacao($content["participacao"]);
        $socio->setCodigoidEmpresa($empresa);

        $this->socioRepository->update($socio);

        return $this->json('Sócio atualizado com sucesso');
    }

    /**
     * @Route("/socio/{id}", methods={"DELETE"})
     */
    public function deletarSocio(string $id): JsonResponse
    {
        $socio = $this->socioRepository->find($id);

        if (!$socio) {
            return $this->json(['error' => 'Sócio não encontrado'], 404);
        }

        $this->socioRepository->delete($socio);

        return $this->json('Sócio deletado com sucesso');
    }
}

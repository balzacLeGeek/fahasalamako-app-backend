<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
use App\Repository\ProduitsRepository;
use App\Repository\MedicamentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/medicament")
 */
class MedicamentController extends AbstractController
{
    /**
     * @Route("/", name="api_medicament_index", methods="GET")
     */
    public function index(ProduitsRepository $produitsRepository, MedicamentRepository $medicamentRepository)
    {
        $medicamentListe = [];

        foreach($medicamentRepository->findAll() as $medicament) {
            $pharmacieListe = $produitsRepository->findBy(['medicament' => $medicament]);
            $medicamentListe[] = ResponseFormat::ShowMedicament($pharmacieListe, $medicament);
        }

        return new JsonResponse($medicamentListe);
    }

    /**
     * @Route("/{id}", name="api_medicament_show", methods="GET")
     */
    public function show(ProduitsRepository $produitsRepository, MedicamentRepository $medicamentRepository, $id)
    {
        $medicament = $medicamentRepository->find($id);
        $pharmacieListe = $produitsRepository->findBy(['medicament' => $medicament]);
        return new JsonResponse(ResponseFormat::ShowMedicament($pharmacieListe, $medicament));
    }
}

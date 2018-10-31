<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
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
     * @Route("/{id}", name="api_medicament_show", methods="GET")
     */
    public function index(MedicamentRepository $medicamentRepository, $id)
    {
        return new JsonResponse(ResponseFormat::ShowMedicament($medicamentRepository->find($id)));
    }
}

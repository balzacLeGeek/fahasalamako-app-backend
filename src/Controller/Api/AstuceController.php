<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
use App\Entity\Astuces;
use App\Repository\AstucesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\SpecialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/astuces")
 */
class AstuceController extends AbstractController
{
    /**
     * @Route("/", name="api_astuces_index", methods="GET")
     */
    public function index(AstucesRepository $astucesRepository)
    {
        $astucesListe = [];

        foreach($astucesRepository->findAll() as $astuces) {
            $astucesListe[] = ResponseFormat::ShowAstuces($astuces);
        }
        
        return new JsonResponse($astucesListe);
    }

    /**
     * @Route("/{id}", name="api_astuces_show", methods="GET")
     */
    public function show(Astuces $astuces)
    {
        return new JsonResponse(ResponseFormat::ShowAstuces($astuces));
    }
}
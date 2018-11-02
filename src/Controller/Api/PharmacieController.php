<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
use App\Repository\TourGardeRepository;
use App\Repository\PharmacieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/pharmacie")
 */
class PharmacieController extends AbstractController
{
    /**
     * @Route("/", name="api_pharmacie_index", methods="GET")
     */
    public function index(PharmacieRepository $pharmacieRepository, TourGardeRepository $tourGardeRepository)
    {
        $liste = [];
        $isGarde = false;
        
        foreach($pharmacieRepository->findAll() as $pharmacie) {
            $tourGarde = $tourGardeRepository->findBy(['pharmacie' => $pharmacie]);
            if ($tourGarde != null) {
                $isGarde = $tourGarde[0]->getActive();
            }
            $liste[] = ResponseFormat::ShowPharmacie($isGarde, $pharmacie);
            $isGarde = false;
        }
        
        return new JsonResponse($liste);
    }

    /**
     * @Route("/{id}", name="api_pharmacie_show", methods="GET")
     */
    public function show(PharmacieRepository $pharmacieRepository, TourGardeRepository $tourGardeRepository, $id)
    {
        $isGarde = false;
        $pharmacie = $pharmacieRepository->find($id);
        $tourGarde = $tourGardeRepository->findBy(['pharmacie' => $pharmacie]);
        if ($tourGarde != null) {
            $isGarde = $tourGarde[0]->getActive();
        }

        return new JsonResponse(ResponseFormat::ShowPharmacie($isGarde,  $pharmacie));
    }
}

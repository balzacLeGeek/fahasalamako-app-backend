<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
use App\Services\Header;
use App\Entity\Docteur;
use App\Repository\DocteurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\SpecialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/docteur")
 */
class DocteurController extends AbstractController
{
    /**
     * @Route("/", name="api_docteur_index", methods="GET")
     */
    public function index(DocteurRepository $docteurRepository)
    {
        $docteurListe = [];

        foreach($docteurRepository->findAll() as $docteur) {
            $docteurListe[] = ResponseFormat::ShowDocteur($docteur);
        }
        
        return new JsonResponse($docteurListe);
    }

    /**
     * @Route("/{id}", name="api_docteur_show", methods="GET")
     */
    public function show(Docteur $docteur)
    {
        return new JsonResponse(ResponseFormat::ShowDocteur($docteur));
    }

    /**
     * @Route("/specialite", name="api_docteur_show", methods="GET")
     */
    public function specialite(SpecialiteRepository $specialiteRepository)
    {
        foreach($specialiteRepository->findAll() as $specialite) {
            $specialiteListe[] = ResponseFormat::ShowSpecialite($specialite);
        }
        return new JsonResponse($specialiteListe);
    }
}
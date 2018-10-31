<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
use App\Repository\PharmacyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/pharmacy")
 */
class PharmacyController extends AbstractController
{
    /**
     * @Route("/", name="api_pharmacy_index", methods="GET")
     */
    public function index(PharmacyRepository $pharmacyRepository)
    {
        $liste = [];
        
        foreach($pharmacyRepository->findAll() as $pharmacy) {
            $liste[] = ResponseFormat::ListePharmacy($pharmacy);
        }
        
        return new JsonResponse($liste);
    }
}

<?php

namespace App\Controller\Api;

use App\Services\ResponseFormat;
use App\Repository\ProduitsRepository;
use App\Repository\PathologieRepository;
use App\Repository\MedicamentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/pathologie")
 */
class PathologieController extends AbstractController
{
    
    /**
     * @Route("/", name="api_pathologie_index", methods="GET")
     */
    public function pathologieShow(PathologieRepository $pathologieRepository)
    {
        $pathologieListe = [];
        
        foreach($pathologieRepository->findAll() as $pathologie) {
            $pathologieListe[] = ResponseFormat::pathologieShow($pathologie);
        }
        
        return new JsonResponse($pathologieListe);
    }

    /**
     * @Route("/{id_pathologie}", name="api_pathologie_list", methods="GET")
     */
    public function showByPathologie(PathologieRepository $pathologieRepository, ProduitsRepository $produitsRepository, MedicamentRepository $medicamentRepository, $id_pathologie)
    {
        $pathologie = $pathologieRepository->find($id_pathologie);
        $pathologieListe = [];

        foreach($medicamentRepository->findByPathologie($pathologie) as $medicament) {
            $pharmacieListe = $produitsRepository->findBy(['medicament' => $medicament]);
            $pathologieListe[] = ResponseFormat::ShowMedicament($pharmacieListe, $medicament);
        }

        return new JsonResponse($pathologieListe);
    }
}

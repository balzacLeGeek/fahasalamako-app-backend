<?php

namespace App\Controller;

use App\Entity\TourGarde;
use App\Form\TourGardeType;
use App\Repository\TourGardeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tour/garde")
 */
class TourGardeController extends AbstractController
{
    /**
     * @Route("/", name="tour_garde_index", methods="GET")
     */
    public function index(TourGardeRepository $tourGardeRepository): Response
    {
        return $this->render('tour_garde/index.html.twig', ['tour_gardes' => $tourGardeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tour_garde_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tourGarde = new TourGarde();
        $form = $this->createForm(TourGardeType::class, $tourGarde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tourGarde);
            $em->flush();

            return $this->redirectToRoute('tour_garde_index');
        }

        return $this->render('tour_garde/new.html.twig', [
            'tour_garde' => $tourGarde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tour_garde_show", methods="GET")
     */
    public function show(TourGarde $tourGarde): Response
    {
        return $this->render('tour_garde/show.html.twig', ['tour_garde' => $tourGarde]);
    }

    /**
     * @Route("/{id}/edit", name="tour_garde_edit", methods="GET|POST")
     */
    public function edit(Request $request, TourGarde $tourGarde): Response
    {
        $form = $this->createForm(TourGardeType::class, $tourGarde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tour_garde_edit', ['id' => $tourGarde->getId()]);
        }

        return $this->render('tour_garde/edit.html.twig', [
            'tour_garde' => $tourGarde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tour_garde_delete", methods="DELETE")
     */
    public function delete(Request $request, TourGarde $tourGarde): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tourGarde->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tourGarde);
            $em->flush();
        }

        return $this->redirectToRoute('tour_garde_index');
    }
}

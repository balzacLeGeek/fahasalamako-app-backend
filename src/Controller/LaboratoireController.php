<?php

namespace App\Controller;

use App\Entity\Laboratoire;
use App\Form\LaboratoireType;
use App\Repository\LaboratoireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/laboratoire")
 */
class LaboratoireController extends AbstractController
{
    /**
     * @Route("/", name="laboratoire_index", methods="GET")
     */
    public function index(LaboratoireRepository $laboratoireRepository): Response
    {
        return $this->render('laboratoire/index.html.twig', ['laboratoires' => $laboratoireRepository->findAll()]);
    }

    /**
     * @Route("/new", name="laboratoire_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $laboratoire = new Laboratoire();
        $form = $this->createForm(LaboratoireType::class, $laboratoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($laboratoire);
            $em->flush();

            return $this->redirectToRoute('laboratoire_index');
        }

        return $this->render('laboratoire/new.html.twig', [
            'laboratoire' => $laboratoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="laboratoire_show", methods="GET")
     */
    public function show(Laboratoire $laboratoire): Response
    {
        return $this->render('laboratoire/show.html.twig', ['laboratoire' => $laboratoire]);
    }

    /**
     * @Route("/{id}/edit", name="laboratoire_edit", methods="GET|POST")
     */
    public function edit(Request $request, Laboratoire $laboratoire): Response
    {
        $form = $this->createForm(LaboratoireType::class, $laboratoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('laboratoire_edit', ['id' => $laboratoire->getId()]);
        }

        return $this->render('laboratoire/edit.html.twig', [
            'laboratoire' => $laboratoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="laboratoire_delete", methods="DELETE")
     */
    public function delete(Request $request, Laboratoire $laboratoire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laboratoire->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($laboratoire);
            $em->flush();
        }

        return $this->redirectToRoute('laboratoire_index');
    }
}

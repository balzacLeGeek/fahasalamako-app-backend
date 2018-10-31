<?php

namespace App\Controller;

use App\Entity\Laboratory;
use App\Form\LaboratoryType;
use App\Repository\LaboratoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/laboratory")
 */
class LaboratoryController extends AbstractController
{
    /**
     * @Route("/", name="laboratory_index", methods="GET")
     */
    public function index(LaboratoryRepository $laboratoryRepository): Response
    {
        return $this->render('laboratory/index.html.twig', ['laboratories' => $laboratoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="laboratory_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $laboratory = new Laboratory();
        $form = $this->createForm(LaboratoryType::class, $laboratory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($laboratory);
            $em->flush();

            return $this->redirectToRoute('laboratory_index');
        }

        return $this->render('laboratory/new.html.twig', [
            'laboratory' => $laboratory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="laboratory_show", methods="GET")
     */
    public function show(Laboratory $laboratory): Response
    {
        return $this->render('laboratory/show.html.twig', ['laboratory' => $laboratory]);
    }

    /**
     * @Route("/{id}/edit", name="laboratory_edit", methods="GET|POST")
     */
    public function edit(Request $request, Laboratory $laboratory): Response
    {
        $form = $this->createForm(LaboratoryType::class, $laboratory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('laboratory_edit', ['id' => $laboratory->getId()]);
        }

        return $this->render('laboratory/edit.html.twig', [
            'laboratory' => $laboratory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="laboratory_delete", methods="DELETE")
     */
    public function delete(Request $request, Laboratory $laboratory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laboratory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($laboratory);
            $em->flush();
        }

        return $this->redirectToRoute('laboratory_index');
    }
}

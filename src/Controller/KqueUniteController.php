<?php

namespace App\Controller;

use App\Entity\KqueUnite;
use App\Form\KqueUniteType;
use App\Repository\KqueUniteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kque/unite")
 */
class KqueUniteController extends AbstractController
{
    /**
     * @Route("/", name="kque_unite_index", methods="GET")
     */
    public function index(KqueUniteRepository $kqueUniteRepository): Response
    {
        return $this->render('kque_unite/index.html.twig', ['kque_unites' => $kqueUniteRepository->findAll()]);
    }

    /**
     * @Route("/new", name="kque_unite_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $kqueUnite = new KqueUnite();
        $form = $this->createForm(KqueUniteType::class, $kqueUnite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kqueUnite);
            $em->flush();

            return $this->redirectToRoute('kque_unite_index');
        }

        return $this->render('kque_unite/new.html.twig', [
            'kque_unite' => $kqueUnite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kque_unite_show", methods="GET")
     */
    public function show(KqueUnite $kqueUnite): Response
    {
        return $this->render('kque_unite/show.html.twig', ['kque_unite' => $kqueUnite]);
    }

    /**
     * @Route("/{id}/edit", name="kque_unite_edit", methods="GET|POST")
     */
    public function edit(Request $request, KqueUnite $kqueUnite): Response
    {
        $form = $this->createForm(KqueUniteType::class, $kqueUnite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kque_unite_edit', ['id' => $kqueUnite->getId()]);
        }

        return $this->render('kque_unite/edit.html.twig', [
            'kque_unite' => $kqueUnite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kque_unite_delete", methods="DELETE")
     */
    public function delete(Request $request, KqueUnite $kqueUnite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kqueUnite->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kqueUnite);
            $em->flush();
        }

        return $this->redirectToRoute('kque_unite_index');
    }
}

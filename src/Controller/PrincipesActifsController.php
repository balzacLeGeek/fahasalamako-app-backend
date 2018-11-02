<?php

namespace App\Controller;

use App\Entity\PrincipesActifs;
use App\Form\PrincipesActifsType;
use App\Repository\PrincipesActifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/principes/actifs")
 */
class PrincipesActifsController extends AbstractController
{
    /**
     * @Route("/", name="principes_actifs_index", methods="GET")
     */
    public function index(PrincipesActifsRepository $principesActifsRepository): Response
    {
        return $this->render('principes_actifs/index.html.twig', ['principes_actifs' => $principesActifsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="principes_actifs_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $principesActif = new PrincipesActifs();
        $form = $this->createForm(PrincipesActifsType::class, $principesActif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($principesActif);
            $em->flush();

            return $this->redirectToRoute('principes_actifs_index');
        }

        return $this->render('principes_actifs/new.html.twig', [
            'principes_actif' => $principesActif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principes_actifs_show", methods="GET")
     */
    public function show(PrincipesActifs $principesActif): Response
    {
        return $this->render('principes_actifs/show.html.twig', ['principes_actif' => $principesActif]);
    }

    /**
     * @Route("/{id}/edit", name="principes_actifs_edit", methods="GET|POST")
     */
    public function edit(Request $request, PrincipesActifs $principesActif): Response
    {
        $form = $this->createForm(PrincipesActifsType::class, $principesActif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('principes_actifs_edit', ['id' => $principesActif->getId()]);
        }

        return $this->render('principes_actifs/edit.html.twig', [
            'principes_actif' => $principesActif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principes_actifs_delete", methods="DELETE")
     */
    public function delete(Request $request, PrincipesActifs $principesActif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principesActif->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($principesActif);
            $em->flush();
        }

        return $this->redirectToRoute('principes_actifs_index');
    }
}

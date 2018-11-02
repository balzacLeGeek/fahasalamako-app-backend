<?php

namespace App\Controller;

use App\Entity\Pathologie;
use App\Form\PathologieType;
use App\Repository\PathologieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pathologie")
 */
class PathologieController extends AbstractController
{
    /**
     * @Route("/", name="pathologie_index", methods="GET")
     */
    public function index(PathologieRepository $pathologieRepository): Response
    {
        return $this->render('pathologie/index.html.twig', ['pathologies' => $pathologieRepository->findAll()]);
    }

    /**
     * @Route("/new", name="pathologie_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pathologie = new Pathologie();
        $form = $this->createForm(PathologieType::class, $pathologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pathologie);
            $em->flush();

            return $this->redirectToRoute('pathologie_index');
        }

        return $this->render('pathologie/new.html.twig', [
            'pathologie' => $pathologie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pathologie_show", methods="GET")
     */
    public function show(Pathologie $pathologie): Response
    {
        return $this->render('pathologie/show.html.twig', ['pathologie' => $pathologie]);
    }

    /**
     * @Route("/{id}/edit", name="pathologie_edit", methods="GET|POST")
     */
    public function edit(Request $request, Pathologie $pathologie): Response
    {
        $form = $this->createForm(PathologieType::class, $pathologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pathologie_edit', ['id' => $pathologie->getId()]);
        }

        return $this->render('pathologie/edit.html.twig', [
            'pathologie' => $pathologie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pathologie_delete", methods="DELETE")
     */
    public function delete(Request $request, Pathologie $pathologie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pathologie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pathologie);
            $em->flush();
        }

        return $this->redirectToRoute('pathologie_index');
    }
}

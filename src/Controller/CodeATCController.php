<?php

namespace App\Controller;

use App\Entity\CodeATC;
use App\Form\CodeATCType;
use App\Repository\CodeATCRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/code/a/t/c")
 */
class CodeATCController extends AbstractController
{
    /**
     * @Route("/", name="code_a_t_c_index", methods="GET")
     */
    public function index(CodeATCRepository $codeATCRepository): Response
    {
        return $this->render('code_atc/index.html.twig', ['code_a_t_cs' => $codeATCRepository->findAll()]);
    }

    /**
     * @Route("/new", name="code_a_t_c_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $codeATC = new CodeATC();
        $form = $this->createForm(CodeATCType::class, $codeATC);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($codeATC);
            $em->flush();

            return $this->redirectToRoute('code_a_t_c_index');
        }

        return $this->render('code_atc/new.html.twig', [
            'code_a_t_c' => $codeATC,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="code_a_t_c_show", methods="GET")
     */
    public function show(CodeATC $codeATC): Response
    {
        return $this->render('code_atc/show.html.twig', ['code_a_t_c' => $codeATC]);
    }

    /**
     * @Route("/{id}/edit", name="code_a_t_c_edit", methods="GET|POST")
     */
    public function edit(Request $request, CodeATC $codeATC): Response
    {
        $form = $this->createForm(CodeATCType::class, $codeATC);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('code_a_t_c_edit', ['id' => $codeATC->getId()]);
        }

        return $this->render('code_atc/edit.html.twig', [
            'code_a_t_c' => $codeATC,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="code_a_t_c_delete", methods="DELETE")
     */
    public function delete(Request $request, CodeATC $codeATC): Response
    {
        if ($this->isCsrfTokenValid('delete'.$codeATC->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($codeATC);
            $em->flush();
        }

        return $this->redirectToRoute('code_a_t_c_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\MedicamentCategory;
use App\Form\MedicamentCategoryType;
use App\Repository\MedicamentCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medicament/category")
 */
class MedicamentCategoryController extends AbstractController
{
    /**
     * @Route("/", name="medicament_category_index", methods="GET")
     */
    public function index(MedicamentCategoryRepository $medicamentCategoryRepository): Response
    {
        return $this->render('medicament_category/index.html.twig', ['medicament_categories' => $medicamentCategoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="medicament_category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $medicamentCategory = new MedicamentCategory();
        $form = $this->createForm(MedicamentCategoryType::class, $medicamentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medicamentCategory);
            $em->flush();

            return $this->redirectToRoute('medicament_category_index');
        }

        return $this->render('medicament_category/new.html.twig', [
            'medicament_category' => $medicamentCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicament_category_show", methods="GET")
     */
    public function show(MedicamentCategory $medicamentCategory): Response
    {
        return $this->render('medicament_category/show.html.twig', ['medicament_category' => $medicamentCategory]);
    }

    /**
     * @Route("/{id}/edit", name="medicament_category_edit", methods="GET|POST")
     */
    public function edit(Request $request, MedicamentCategory $medicamentCategory): Response
    {
        $form = $this->createForm(MedicamentCategoryType::class, $medicamentCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicament_category_edit', ['id' => $medicamentCategory->getId()]);
        }

        return $this->render('medicament_category/edit.html.twig', [
            'medicament_category' => $medicamentCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicament_category_delete", methods="DELETE")
     */
    public function delete(Request $request, MedicamentCategory $medicamentCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicamentCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medicamentCategory);
            $em->flush();
        }

        return $this->redirectToRoute('medicament_category_index');
    }
}

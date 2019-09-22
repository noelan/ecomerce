<?php

namespace App\Controller;

use App\Entity\Cloth;
use App\Form\ClothType;
use App\Repository\ClothRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cloth")
 */
class ClothController extends AbstractController
{
    /**
     * @Route("/", name="cloth_index", methods={"GET"})
     */
    public function index(ClothRepository $clothRepository): Response
    {
        return $this->render('cloth/index.html.twig', [
            'cloths' => $clothRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cloth_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cloth = new Cloth();
        $form = $this->createForm(ClothType::class, $cloth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cloth);
            $entityManager->flush();

            return $this->redirectToRoute('cloth_index');
        }

        return $this->render('cloth/new.html.twig', [
            'cloth' => $cloth,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cloth_show", methods={"GET"})
     */
    public function show(Cloth $cloth): Response
    {
        return $this->render('cloth/show.html.twig', [
            'cloth' => $cloth,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cloth_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cloth $cloth): Response
    {
        $form = $this->createForm(ClothType::class, $cloth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cloth_index');
        }

        return $this->render('cloth/edit.html.twig', [
            'cloth' => $cloth,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cloth_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cloth $cloth): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cloth->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cloth);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cloth_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Piezas;
use App\Form\PiezasType;
use App\Repository\PiezasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/piezas")
 */
class PiezasController extends AbstractController
{
    /**
     * @Route("/", name="app_piezas_index", methods={"GET"})
     */
    public function index(PiezasRepository $piezasRepository): Response
    {
        return $this->render('piezas/index.html.twig', [
            'piezas' => $piezasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_piezas_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PiezasRepository $piezasRepository): Response
    {
        $pieza = new Piezas();
        $form = $this->createForm(PiezasType::class, $pieza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $piezasRepository->add($pieza, true);

            return $this->redirectToRoute('app_piezas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piezas/new.html.twig', [
            'pieza' => $pieza,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_piezas_show", methods={"GET"})
     */
    public function show(Piezas $pieza): Response
    {
        return $this->render('piezas/show.html.twig', [
            'pieza' => $pieza,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_piezas_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Piezas $pieza, PiezasRepository $piezasRepository): Response
    {
        $form = $this->createForm(PiezasType::class, $pieza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $piezasRepository->add($pieza, true);

            return $this->redirectToRoute('app_piezas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piezas/edit.html.twig', [
            'pieza' => $pieza,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_piezas_delete", methods={"POST"})
     */
    public function delete(Request $request, Piezas $pieza, PiezasRepository $piezasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pieza->getId(), $request->request->get('_token'))) {
            $piezasRepository->remove($pieza, true);
        }

        return $this->redirectToRoute('app_piezas_index', [], Response::HTTP_SEE_OTHER);
    }
}

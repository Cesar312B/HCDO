<?php

namespace App\Controller;

use App\Entity\Vacunas;
use App\Form\VacunasType;
use App\Repository\VacunasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/vacunas")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class VacunasController extends AbstractController
{
    /**
     * @Route("/", name="vacunas_index", methods={"GET"})
     */
    public function index(VacunasRepository $vacunasRepository): Response
    {
        return $this->render('vacunas/index.html.twig', [
            'vacunas' => $vacunasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vacunas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vacuna = new Vacunas();
        $form = $this->createForm(VacunasType::class, $vacuna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vacuna);
            $entityManager->flush();

            return $this->redirectToRoute('vacunas_index');
        }

        return $this->render('vacunas/new.html.twig', [
            'vacuna' => $vacuna,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vacunas_show", methods={"GET"})
     */
    public function show(Vacunas $vacuna): Response
    {
        return $this->render('vacunas/show.html.twig', [
            'vacuna' => $vacuna,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vacunas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vacunas $vacuna): Response
    {
        $form = $this->createForm(VacunasType::class, $vacuna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vacunas_index');
        }

        return $this->render('vacunas/edit.html.twig', [
            'vacuna' => $vacuna,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vacunas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vacunas $vacuna): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacuna->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vacuna);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vacunas_index');
    }
}

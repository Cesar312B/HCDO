<?php

namespace App\Controller;

use App\Entity\Pacientes;
use App\Entity\SignosVitales;
use App\Form\SignosVitalesType;
use App\Repository\SignosVitalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/signos/vitales")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class SignosVitalesController extends AbstractController
{
    /**
     * @Route("/", name="signos_vitales_index", methods={"GET"})
     */
    public function index(SignosVitalesRepository $signosVitalesRepository): Response
    {
        return $this->render('signos_vitales/index.html.twig', [
            'signos_vitales' => $signosVitalesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="signos_vitales_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $signosVitale = new SignosVitales();
        $form = $this->createForm(SignosVitalesType::class, $signosVitale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($signosVitale);
            $entityManager->flush();

            return $this->redirectToRoute('signos_vitales_index');
        }

        return $this->render('signos_vitales/new.html.twig', [
            'signos_vitale' => $signosVitale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="signos_vitales_show", methods={"GET"})
     */
    public function show(SignosVitales $signosVitale): Response
    {
        return $this->render('signos_vitales/show.html.twig', [
            'signos_vitale' => $signosVitale,
        ]);
    }

    /**
     * @Route("/s_vitales/{id}/paciente/{p}", name="signos_vitales_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SignosVitales $signosVitale, $p): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $form = $this->createForm(SignosVitalesType::class, $signosVitale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('signos_vitales/edit.html.twig', [
            'paciente'=>$paciente,
            'signos_vitale' => $signosVitale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="signos_vitales_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SignosVitales $signosVitale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$signosVitale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($signosVitale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('signos_vitales_index');
    }
}

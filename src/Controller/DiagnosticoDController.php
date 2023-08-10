<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\DiagnosticoD;
use App\Entity\Pacientes;
use App\Form\DiagnosticoDType;
use App\Repository\DiagnosticoDRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/diagnostico_dental")
 */
class DiagnosticoDController extends AbstractController
{
    /**
     * @Route("/", name="app_diagnostico_d_index", methods={"GET"})
     */
    public function index(DiagnosticoDRepository $diagnosticoDRepository): Response
    {
        return $this->render('diagnostico_d/index.html.twig', [
            'diagnostico_ds' => $diagnosticoDRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="app_diagnostico_d_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DiagnosticoDRepository $diagnosticoDRepository,$c,$id): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);

        $diagnosticoD = new DiagnosticoD();
        $form = $this->createForm(DiagnosticoDType::class, $diagnosticoD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $diagnosticoD->setConsulta($consulta);
            $diagnosticoDRepository->add($diagnosticoD, true);
            return $this->redirect($request->getUri());

        }

        return $this->renderForm('diagnostico_d/new.html.twig', [
            'diagnostico_d' => $diagnosticoD,
            'form' => $form,
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'diagnostico' => $diagnosticoDRepository->findBy(['consulta'=>$consulta]),
            'diagnostico_df' => $diagnosticoDRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_diagnostico_d_show", methods={"GET"})
     */
    public function show(DiagnosticoD $diagnosticoD): Response
    {
        return $this->render('diagnostico_d/show.html.twig', [
            'diagnostico_d' => $diagnosticoD,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="app_diagnostico_d_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DiagnosticoD $diagnosticoD, DiagnosticoDRepository $diagnosticoDRepository,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(DiagnosticoDType::class, $diagnosticoD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diagnosticoDRepository->add($diagnosticoD, true);

            return $this->redirect($request->getUri());
        }

        return $this->renderForm('diagnostico_d/edit.html.twig', [
            'diagnostico_d' => $diagnosticoD,
            'form' => $form,
            'consulta'=>$consulta,
            'paciente'=>$paciente,
        ]);
    }


    /**
     * @Route("/{id}", name="delate_diagnostico_d")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(DiagnosticoD::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

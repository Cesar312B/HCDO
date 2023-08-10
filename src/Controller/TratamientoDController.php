<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\DiagnosticoD;
use App\Entity\Pacientes;
use App\Entity\TratamientoD;
use App\Form\TratamientoDType;
use App\Repository\TratamientoDRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/tratamiento/d")
 */
class TratamientoDController extends AbstractController
{
    /**
     * @Route("/", name="app_tratamiento_d_index", methods={"GET"})
     */
    public function index(TratamientoDRepository $tratamientoDRepository): Response
    {
        return $this->render('tratamiento_d/index.html.twig', [
            'tratamiento_ds' => $tratamientoDRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{p}/diagnostico/{id}/consulta/{c}", name="app_tratamiento_d_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TratamientoDRepository $tratamientoDRepository,$id,$p,$c): Response
    {  
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $diagnostico= $em->getRepository(DiagnosticoD::class)->find($id);
        
        $tratamientoD = new TratamientoD();
        $form = $this->createForm(TratamientoDType::class, $tratamientoD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tratamientoD->setDiagnostico($diagnostico);
            $tratamientoDRepository->add($tratamientoD, true);
            return $this->redirect($request->getUri());
        }

        return $this->renderForm('tratamiento_d/new.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'diagnostico' =>$diagnostico,
            'tratamiento_ds' => $tratamientoDRepository->findBy(['diagnostico'=>$diagnostico]),
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_tratamiento_d_show", methods={"GET"})
     */
    public function show(TratamientoD $tratamientoD): Response
    {
        return $this->render('tratamiento_d/show.html.twig', [
            'tratamiento_d' => $tratamientoD,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_tratamiento_d_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TratamientoD $tratamientoD, TratamientoDRepository $tratamientoDRepository): Response
    {
        $form = $this->createForm(TratamientoDType::class, $tratamientoD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tratamientoDRepository->add($tratamientoD, true);

            return $this->redirectToRoute('app_tratamiento_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tratamiento_d/edit.html.twig', [
            'tratamiento_d' => $tratamientoD,
            'form' => $form,
        ]);
    }

        /**
     * @Route("/{id}", name="tratamiento_dental_delete")
     * @Method({"DELETE"})
     */
    public function delete(Request $request,$id)
    {
        $antecedente= $this->getDoctrine()->getRepository(TratamientoD::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
      
    }
}

<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\Diagnostico;
use App\Entity\Pacientes;
use App\Entity\Tratamiento;
use App\Form\TratamientoType;
use App\Repository\TratamientoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/tratamiento")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class TratamientoController extends AbstractController
{
    /**
     * @Route("/", name="tratamiento_index", methods={"GET"})
     */
    public function index(TratamientoRepository $tratamientoRepository): Response
    {
        return $this->render('tratamiento/index.html.twig', [
            'tratamientos' => $tratamientoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{p}/consulta/{c}/diagnostico/{d}", name="tratamiento_new", methods={"GET","POST"})
     */
    public function new(Request $request,$p,$c,$d,TratamientoRepository $tratamientoRepository): Response
    {
    
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $diagnostico= $em->getRepository(Diagnostico::class)->find($d);

        $tratamiento = new Tratamiento();
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
            $tratamiento->setDiagnostico($diagnostico);
            $entityManager->persist($tratamiento);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');
            return $this->redirect($request->getUri());
          
        }

        return $this->render('tratamiento/new.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'diagnostico' =>$diagnostico,
            'tratamientos' => $tratamientoRepository->findBy(['diagnostico'=>$diagnostico]),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tratamiento_show", methods={"GET"})
     */
    public function show(Tratamiento $tratamiento): Response
    {
        return $this->render('tratamiento/show.html.twig', [
            'tratamiento' => $tratamiento,
        ]);
    }

    /**
     * @Route("/trat/{id}/paciente/{p}/consulta/{c}/diagnostico/{d}/", name="tratamiento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tratamiento $tratamiento,$p,$d,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $diagnostico= $em->getRepository(Diagnostico::class)->find($d);
      
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('tratamiento/edit.html.twig', [
            'consulta'=>$consulta,
            'diagnostico' =>$diagnostico,
            'paciente'=>$paciente,
            'tratamiento' => $tratamiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tratamiento_delete")
     * @Method({"DELETE"})
     */
    public function delete(Request $request,$id)
    {
        $antecedente= $this->getDoctrine()->getRepository(Tratamiento::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
      
    }
}

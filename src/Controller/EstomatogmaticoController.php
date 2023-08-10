<?php

namespace App\Controller;

use App\Entity\Estomatogmatico;
use App\Form\EstomatogmaticoType;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Repository\EstomatogmaticoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/estomatogmatico")
 */
class EstomatogmaticoController extends AbstractController
{
    /**
     * @Route("/", name="app_estomatogmatico_index", methods={"GET"})
     */
    public function index(EstomatogmaticoRepository $estomatogmaticoRepository): Response
    {
        return $this->render('estomatogmatico/index.html.twig', [
            'estomatogmaticos' => $estomatogmaticoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="app_estomatogmatico_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EstomatogmaticoRepository $estomatogmaticoRepository,$id,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $est= $estomatogmaticoRepository->findBy(['consulta'=>$consulta]);
        $estomatogmatico = new Estomatogmatico();
        $form = $this->createForm(EstomatogmaticoType::class, $estomatogmatico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $estomatogmatico->setConsulta($consulta);
             $estomatogmaticoRepository->add($estomatogmatico, true);
             return $this->redirect($request->getUri());
             $this->addFlash('exito','Registro Guardado con Éxito');
        }

        return $this->renderForm('estomatogmatico/new.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'estomatogmatico' => $estomatogmatico,
            'estomatogmaticos'=>$est,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_estomatogmatico_show", methods={"GET"})
     */
    public function show(Estomatogmatico $estomatogmatico): Response
    {
        return $this->render('estomatogmatico/show.html.twig', [
            'estomatogmatico' => $estomatogmatico,
        ]);
    }

    /**
     * @Route("/estp/{id}/paciente/{p}/consulta{c}", name="app_estomatogmatico_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Estomatogmatico $estomatogmatico, EstomatogmaticoRepository $estomatogmaticoRepository,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(EstomatogmaticoType::class, $estomatogmatico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estomatogmaticoRepository->add($estomatogmatico, true);
            return $this->redirect($request->getUri());
            $this->addFlash('exito','Registro Actualizado con éxito');
        }

        return $this->renderForm('estomatogmatico/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'estomatogmatico' => $estomatogmatico,
            'form' => $form,
        ]);
    }

 
     /**
     * @Route("/{id}", name="delate_estomatogmatico")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(Estomatogmatico::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\Nutricional;
use App\Entity\Pacientes;
use App\Form\DNutricionalType;
use App\Form\NutricionalType;
use App\Form\NutricionalType2;
use App\Repository\ConsultaRepository;
use App\Repository\NutricionalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



/**
 * @Route("/nutricional")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class NutricionalController extends AbstractController
{
    /**
     * @Route("/", name="nutricional_index", methods={"GET"})
     */
    public function index(NutricionalRepository $nutricionalRepository): Response
    {
        return $this->render('nutricional/index.html.twig', [
            'nutricionals' => $nutricionalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="nutricional_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,ConsultaRepository $consultaRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $fecha_consulta = $consulta->getFechaAtencion();
        $c= $consultaRepository->consulta_nutricional($consulta->getId());
        $c2= $consultaRepository->consulta_nutricional_full($paciente->getId(),$consulta->getId(),$fecha_consulta);
        $form2 = $this->createForm(DNutricionalType::class, $consulta);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($consulta);
            $entityManager->flush();
            return $this->redirect($request->getUri());
        }

        $nutricional = new Nutricional();
        $form = $this->createForm(NutricionalType::class, $nutricional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $nutricional->setConsulta($consulta);
            $entityManager->persist($nutricional);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('nutricional/new.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            't'=>$c,
            't2'=>$c2,
            'nutricional' => $nutricional,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nutricional_show", methods={"GET"})
     */
    public function show(Nutricional $nutricional): Response
    {
        return $this->render('nutricional/show.html.twig', [
            'nutricional' => $nutricional,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="nutricional_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Nutricional $nutricional,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(NutricionalType::class, $nutricional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($request->getUri());
           
        }

        return $this->render('nutricional/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'nutricional' => $nutricional,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/copiar/paciente/{p}/antecedente/{id}/consulta/{c}", name="nutricional_copiar", methods={"GET","POST"})
     */
    public function copiar(Request $request, Nutricional $nutricional,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $nutricional2 = new Nutricional();
        $form = $this->createForm(NutricionalType2::class, $nutricional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $nutricional2->setConsulta($consulta);
            $nutricional2->setSuptipoNutricional($data->getSuptipoNutricional());
            $nutricional2->setDescripcionHab($data->getDescripcionHab());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nutricional2);
            $entityManager->flush();

            return $this->redirect($request->getUri());
           
        }

        return $this->render('nutricional/copy.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'nutricional' => $nutricional,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_nutricional")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(Nutricional::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();

    }
}

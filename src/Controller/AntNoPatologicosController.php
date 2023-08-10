<?php

namespace App\Controller;

use App\Entity\AntNoPatologicos;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Form\AntNoPatologicosType;
use App\Repository\AntNoPatologicosRepository;
use App\Repository\ConsultaRepository;
use App\Repository\PacientesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use DateTime;

/**
 * @Route("/ant/no/patologicos")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class AntNoPatologicosController extends AbstractController
{
    /**
     * @Route("/", name="ant_no_patologicos_index", methods={"GET"})
     */
    public function index(AntNoPatologicosRepository $antNoPatologicosRepository): Response
    {
        return $this->render('ant_no_patologicos/index.html.twig', [
            'ant_no_patologicos' => $antNoPatologicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="ant_no_patologicos_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository,ConsultaRepository $consultaRepository,AntNoPatologicosRepository $antNoPatologicosRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a2=$antNoPatologicosRepository->findBy(['pacientes'=>$paciente]);
        $antNoPatologico = new AntNoPatologicos();
        $form = $this->createForm(AntNoPatologicosType::class, $antNoPatologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $antNoPatologico->setPacientes($paciente);
            $antNoPatologico->setCreatdate(new DateTime());
            $entityManager->persist($antNoPatologico);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('ant_no_patologicos/new.html.twig', [
            'consulta'=>$consulta,
            'antecedentes2'=>$a2,
            'paciente'=>$paciente,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ant_no_patologicos_show", methods={"GET"})
     */
    public function show(AntNoPatologicos $antNoPatologico): Response
    {
        return $this->render('ant_no_patologicos/show.html.twig', [
            'ant_no_patologico' => $antNoPatologico,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="ant_no_patologicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AntNoPatologicos $antNoPatologico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(AntNoPatologicosType::class, $antNoPatologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antNoPatologico->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('ant_no_patologicos/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'ant_no_patologico' => $antNoPatologico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_nopatologicos")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(AntNoPatologicos::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
       
    }
}
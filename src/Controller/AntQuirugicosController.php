<?php

namespace App\Controller;

use App\Entity\AntQuirugicos;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Form\AntQuirugicosType;
use App\Repository\PacientesRepository;
use App\Repository\AntQuirugicosRepository;
use App\Repository\ConsultaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use DateTime;

/**
 * @Route("/ant/quirugicos")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class AntQuirugicosController extends AbstractController
{
    /**
     * @Route("/", name="ant_quirugicos_index", methods={"GET"})
     */
    public function index(AntQuirugicosRepository $antQuirugicosRepository): Response
    {
        return $this->render('ant_quirugicos/index.html.twig', [
            'ant_quirugicos' => $antQuirugicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="ant_quirugicos_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository,ConsultaRepository $consultaRepository,AntQuirugicosRepository $antQuirugicosRepository): Response
    {

        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a2=$antQuirugicosRepository->findBy(['pacientes'=>$paciente]);
        $antQuirugico = new AntQuirugicos();
        $form = $this->createForm(AntQuirugicosType::class, $antQuirugico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $antQuirugico->setPacientes($paciente);
            $antQuirugico->setCreatdate(new DateTime());
            $entityManager->persist($antQuirugico);
            $entityManager->flush();
            return $this->redirect($request->getUri());
        }

        return $this->render('ant_quirugicos/new.html.twig', [
            'consulta'=>$consulta,
            'antecedentes2'=>$a2,
            'paciente'=>$paciente,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ant_quirugicos_show", methods={"GET"})
     */
    public function show(AntQuirugicos $antQuirugico): Response
    {
        return $this->render('ant_quirugicos/show.html.twig', [
            'ant_quirugico' => $antQuirugico,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="ant_quirugicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AntQuirugicos $antQuirugico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(AntQuirugicosType::class, $antQuirugico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antQuirugico->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('ant_quirugicos/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'ant_quirugico' => $antQuirugico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_cirujia")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(AntQuirugicos::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

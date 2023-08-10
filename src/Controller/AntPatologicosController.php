<?php

namespace App\Controller;

use App\Entity\AntPatologicos;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Form\AntPatologicosType;
use App\Repository\AntPatologicosRepository;
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
 * @Route("/ant/patologicos")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class AntPatologicosController extends AbstractController
{
    /**
     * @Route("/", name="ant_patologicos_index", methods={"GET"})
     */
    public function index(AntPatologicosRepository $antPatologicosRepository): Response
    {
        return $this->render('ant_patologicos/index.html.twig', [
            'ant_patologicos' => $antPatologicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente{id}/consulta/{c}", name="ant_patologicos_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository, ConsultaRepository $consultaRepository,AntPatologicosRepository $antPatologicosRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a1=$antPatologicosRepository->findBy(['consulta'=>$consulta,'pacientes'=>$paciente]);
        $a2=$antPatologicosRepository->findBy(['pacientes'=>$paciente]);

        $antPatologico = new AntPatologicos();
        $form = $this->createForm(AntPatologicosType::class, $antPatologico);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $antPatologico->setPacientes($paciente);
            $antPatologico->setConsulta($consulta);
            $antPatologico->setCreatdate(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($antPatologico);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('ant_patologicos/new.html.twig', [
            'consulta'=>$consulta,
            'antecedentes1'=>$a1,
            'antecedentes2'=>$a2,
            'paciente'=>$paciente,
            'ant_patologico' => $antPatologico,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ant_patologicos_show", methods={"GET"})
     */
    public function show(AntPatologicos $antPatologico): Response
    {
        return $this->render('ant_patologicos/show.html.twig', [
            'ant_patologico' => $antPatologico,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="ant_patologicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AntPatologicos $antPatologico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(AntPatologicosType::class, $antPatologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antPatologico->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('ant_patologicos/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'ant_patologico' => $antPatologico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_patologicos")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(AntPatologicos::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
       
    }
}

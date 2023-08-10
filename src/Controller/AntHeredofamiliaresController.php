<?php

namespace App\Controller;

use App\Entity\AntHeredofamiliares;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Form\AntHeredofamiliaresType;
use App\Repository\AntHeredofamiliaresRepository;
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
 * @Route("/ant/heredofamiliares")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class AntHeredofamiliaresController extends AbstractController
{
    /**
     * @Route("/", name="ant_heredofamiliares_index", methods={"GET"})
     */
    public function index(AntHeredofamiliaresRepository $antHeredofamiliaresRepository): Response
    {
        return $this->render('ant_heredofamiliares/index.html.twig', [
            'ant_heredofamiliares' => $antHeredofamiliaresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="ant_heredofamiliares_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c, PacientesRepository $pacientesRepository,ConsultaRepository $consultaRepository,AntHeredofamiliaresRepository $antHeredofamiliaresRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a2= $antHeredofamiliaresRepository->findBy(['pacientes'=>$paciente]);
        $antHeredofamiliare = new AntHeredofamiliares();
        $form = $this->createForm(AntHeredofamiliaresType::class, $antHeredofamiliare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $antHeredofamiliare->setPacientes($paciente);
            $antHeredofamiliare->setCreatdate(new DateTime());
            $entityManager->persist($antHeredofamiliare);
            $entityManager->flush();
            $this->addFlash('exito','Registro guardado con éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('ant_heredofamiliares/new.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'antecedentes2'=>$a2,
            'ant_heredofamiliare' => $antHeredofamiliare,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ant_heredofamiliares_show", methods={"GET"})
     */
    public function show(AntHeredofamiliares $antHeredofamiliare): Response
    {
        return $this->render('ant_heredofamiliares/show.html.twig', [
            'ant_heredofamiliare' => $antHeredofamiliare,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="ant_heredofamiliares_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AntHeredofamiliares $antHeredofamiliare,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(AntHeredofamiliaresType::class, $antHeredofamiliare);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $antHeredofamiliare->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('ant_heredofamiliares/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'ant_heredofamiliare' => $antHeredofamiliare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_herencia")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(AntHeredofamiliares::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

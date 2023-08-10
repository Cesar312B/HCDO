<?php

namespace App\Controller;

use App\Entity\AntReproductivos;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Form\AntReproductivosType;
use App\Repository\AntReproductivosRepository;
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
 * @Route("/ant/reproductivos")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class AntReproductivosController extends AbstractController
{
    /**
     * @Route("/", name="ant_reproductivos_index", methods={"GET"})
     */
    public function index(AntReproductivosRepository $antReproductivosRepository): Response
    {
        return $this->render('ant_reproductivos/index.html.twig', [
            'ant_reproductivos' => $antReproductivosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente{id}/consulta/{c}", name="ant_reproductivos_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository,ConsultaRepository $consultaRepository,AntReproductivosRepository $antReproductivosRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a2=$antReproductivosRepository->findBy(['pacientes'=>$paciente]);
        $antReproductivo = new AntReproductivos();
        $form = $this->createForm(AntReproductivosType::class, $antReproductivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $antReproductivo->setPacientes($paciente);
            $antReproductivo->setCreatdate(new DateTime());
            $entityManager->persist($antReproductivo);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');
            return $this->redirect($request->getUri());
               
        }

        return $this->render('ant_reproductivos/new.html.twig', [
            'consulta'=>$consulta,
            'antecedentes2'=>$a2,
            'paciente'=>$paciente,
            'ant_reproductivo' => $antReproductivo,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form3' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ant_reproductivos_show", methods={"GET"})
     */
    public function show(AntReproductivos $antReproductivo): Response
    {
        return $this->render('ant_reproductivos/show.html.twig', [
            'ant_reproductivo' => $antReproductivo,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="ant_reproductivos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AntReproductivos $antReproductivo,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(AntReproductivosType::class, $antReproductivo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $antReproductivo->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('ant_reproductivos/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'ant_reproductivo' => $antReproductivo,
            'form3' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_reproductivo")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(AntReproductivos::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
       
    }
}

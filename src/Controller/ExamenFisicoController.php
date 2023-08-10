<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\ExamenFisico;
use App\Entity\Pacientes;
use App\Form\ExamenFisicoType;
use App\Form\ExamenFisicoType2;
use App\Repository\ConsultaRepository;
use App\Repository\ExamenesRepository;
use App\Repository\ExamenFisicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/examen/fisico")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class ExamenFisicoController extends AbstractController
{
    /**
     * @Route("/", name="examen_fisico_index", methods={"GET"})
     */
    public function index(ExamenFisicoRepository $examenFisicoRepository): Response
    {
        return $this->render('examen_fisico/index.html.twig', [
            'examen_fisicos' => $examenFisicoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="examen_fisico_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,ConsultaRepository $consultaRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $fecha_consulta = $consulta->getFechaAtencion();
        $a=$consultaRepository->consulta_examenef($consulta->getId());
        $a2=$consultaRepository->consulta_examenefull($paciente->getId(),$consulta->getId(),$fecha_consulta);
        $examenFisico = new ExamenFisico();
        $form = $this->createForm(ExamenFisicoType::class, $examenFisico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $examenFisico->setConsulta($consulta);
            $entityManager->persist($examenFisico);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('examen_fisico/new.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'examen_fisicos'=>$a,
            'examen_fisicos2'=>$a2,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="examen_fisico_show", methods={"GET"})
     */
    public function show(ExamenFisico $examenFisico): Response
    {
        return $this->render('examen_fisico/show.html.twig', [
            'examen_fisico' => $examenFisico,
        ]);
    }

    /**
     * @Route("/fisico/{id}/paciente/{p}/consulta{c}", name="examen_fisico_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ExamenFisico $examenFisico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(ExamenFisicoType::class, $examenFisico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('examen_fisico/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'examen_fisico' => $examenFisico,
            'form' => $form->createView(),
        ]);
    }


      /**
     * @Route("/copiar/fisico/{id}/paciente/{p}/consulta{c}", name="examen_fisico_copiar", methods={"GET","POST"})
     */
    public function copiar(Request $request, ExamenFisico $examenFisico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $examenFisico2 = new ExamenFisico();
        $form = $this->createForm(ExamenFisicoType2::class, $examenFisico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $examenFisico2->setConsulta($consulta);
            $examenFisico2->setPiel($data->getPiel());
            $examenFisico2->setOjos($data->getOjos());
            $examenFisico2->setOido($data->getOido());
            $examenFisico2->setOroFarinje($data->getOroFarinje());
            $examenFisico2->setNariz($data->getNariz());
            $examenFisico2->setCuello($data->getCuello());
            $examenFisico2->setTorax1($data->getTorax1());
            $examenFisico2->setAbdomen($data->getAbdomen());
            $examenFisico2->setColumna($data->getColumna());
            $examenFisico2->setPelvis($data->getPelvis());
            $examenFisico2->setExtremidades($data->getExtremidades());
            $examenFisico2->setNeurologico($data->getNeurologico());
            $examenFisico2->setObservaciones($data->getObservaciones());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($examenFisico2);
            $entityManager->flush();
            $this->addFlash('exito','Registro copiado con exito en la consulta actual');
            return $this->redirect($request->getUri());
        }

        return $this->render('examen_fisico/copy.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'examen_fisico' => $examenFisico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_examenfisico")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(ExamenFisico::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
       
    }
}

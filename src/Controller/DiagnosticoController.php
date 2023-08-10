<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\Diagnostico;
use App\Entity\Pacientes;
use App\Entity\Tratamiento;
use App\Form\DiagnosticoEdit;
use App\Form\DiagnosticoEdit2;
use App\Form\DiagnosticoType;
use App\Repository\ConsultaRepository;
use App\Repository\DiagnosticoRepository;
use App\Repository\PacientesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/diagnostico")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class DiagnosticoController extends AbstractController
{
    /**
     * @Route("/", name="diagnostico_index", methods={"GET"})
     */
    public function index(DiagnosticoRepository $diagnosticoRepository): Response
    {
        return $this->render('diagnostico/index.html.twig', [
            'diagnosticos' => $diagnosticoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="diagnostico_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository, ConsultaRepository $consultaRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $fecha_consulta = $consulta->getFechaAtencion();
        $a=$pacientesRepository->paciennte_Diagnostico($paciente->getId(),$consulta->getId());
        $a2=$pacientesRepository->paciennte_Diagnostico_full($paciente->getId(),$consulta->getId(),$fecha_consulta);
        $tr=$pacientesRepository->paciennte_Diagnostico2($paciente->getId(),$consulta->getId());
        $form = $this->createForm(DiagnosticoType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $diagnostico = new Diagnostico();
            $diagnostico->setPacientes($paciente);
            $diagnostico->setConsulta($consulta);
            $diagnostico->setCie($data['cie']);
            $diagnostico->setTipoDiagnostico($data['tipo_diagnostico']);
            $diagnostico->setSolicitud($data['solicitud']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($diagnostico);
            $entityManager->flush();
           $this->addFlash('exito','Registro Guardado con Éxito');

           return $this->redirect($request->getUri());
           
        }

        return $this->render('diagnostico/new.html.twig', [
             'pedidos'=> $tr,
            'antecedentes'=>$a,
            'antecedentes2'=>$a2,
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="diagnostico_show", methods={"GET"})
     */
    public function show(Diagnostico $diagnostico): Response
    {
        return $this->render('diagnostico/show.html.twig', [
            'diagnostico' => $diagnostico,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="diagnostico_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Diagnostico $diagnostico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(DiagnosticoEdit::class, $diagnostico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('diagnostico/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'diagnostico' => $diagnostico,
            'form' => $form->createView(),
        ]);
    }

    
       /**
     * @Route("/copiar/paciente/{p}/antecedente/{id}/consulta/{c}", name="diagnostico_copiar", methods={"GET","POST"})
     */
    public function copiar(Request $request, Diagnostico $diagnostico,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(DiagnosticoEdit2::class, $diagnostico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $diagnostico2 = new Diagnostico();
            $diagnostico2->setPacientes($paciente);
            $diagnostico2->setConsulta($consulta);
            $diagnostico2->setCie($data->getCie());
            $diagnostico2->setTipoDiagnostico($data->getTipoDiagnostico());
            $diagnostico2->setSolicitud($data->getSolicitud());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($diagnostico2);
            $entityManager->flush();
            $this->addFlash('exito','Registro copiado con exito en la consulta actual');
            return $this->redirect($request->getUri());
        }

        return $this->render('diagnostico/copiar.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'diagnostico' => $diagnostico,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="delate_diagnostico")
     * @Method({"DELETE"})
     */
    public function delete($id) 
    {
        $antecedente= $this->getDoctrine()->getRepository(Diagnostico::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

<?php


namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\ExamenFisico;
use App\Entity\Pacientes;
use App\Entity\SignosVitales;
use App\Form\AptitudType;
use App\Form\ConsultaType;
use App\Form\ConsultaTypeEdit;
use App\Form\RetiroType;
use App\Repository\ConsultaRepository;
use App\Repository\PacientesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/consulta")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class ConsultaController extends AbstractController
{
    /**
     * @Route("/", name="consulta_index", methods={"GET"})
     */
    public function index(ConsultaRepository $consultaRepository): Response
    {
        return $this->render('consulta/index.html.twig', [
            'consultas' => $consultaRepository->findAll(),
            
        ]);
    }



    
    /**
     * @Route("/paciente/{id}", name="consulta_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id, PacientesRepository $pacientesRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $p=$pacientesRepository->consulta_paciente($paciente->getId());
        $puesto= $pacientesRepository->paciente_puestotrabajo($paciente->getId());
        $employe= $this->getUser();
        $form = $this->createForm(ConsultaType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $s_vitales= new SignosVitales();
            $s_vitales->setEstatura($data['estatura']);
            $s_vitales->setPeso($data['peso']);
            $s_vitales->setTemperatura($data['temperatura']);
            $s_vitales->setFrecuenciaRespiratoria($data['frecuencia_respiratoria']);
            $s_vitales->setSistole($data['sistole']);
            $s_vitales->setDiastole($data['diastole']);
            $s_vitales->setFrecuenciaCardiaca($data['frecuencia_cardiaca']);
            $s_vitales->setSaturacionOxigeno($data['saturacion_oxigeno']);
            $consultum = new Consulta();
            $consultum->setMotivoConsulta($data['motivo_consulta']);
            $consultum->setDescripcion($data['descripcion']);
            $consultum->setFechaAtencion($data['fecha_atencion']);
            $consultum->setEmployed($employe);
            $consultum->setPacientes($paciente);
            $consultum->setSignosVitales($s_vitales);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($s_vitales);
            $entityManager->persist($consultum);
            $entityManager->flush();
            $this->addFlash('exito','Registro guardado con éxito');
            return $this->redirect($request->getUri());
        }
        return $this->render('consulta/new.html.twig', [
            'puesto'=>$puesto,
            'consultas'=>$p,
            'paciente'=>$paciente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consulta_show", methods={"GET"})
     */
    public function show(Consulta $consultum): Response
    {
        return $this->render('consulta/show.html.twig', [
            'consultum' => $consultum,
        ]);
    }

    /**
     * @Route("/{id}/paciente/{p}", name="consulta_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Consulta $consultum,$p): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $form = $this->createForm(ConsultaTypeEdit::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('consulta/edit.html.twig', [
            'paciente'=>$paciente,
            'consultum' => $consultum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/aptitud/{id}/paciente/{p}", name="aptitud_edit", methods={"GET","POST"})
     */
    public function apptitud(Request $request, Consulta $consultum,$p, ConsultaRepository $consultaRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $form = $this->createForm(AptitudType::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('consulta/aptitud.html.twig', [
            'paciente'=>$paciente,
            'consulta' => $consultum,
            'c'=>$consultaRepository->consulta_examene($consultum->getId()),
            'form' => $form->createView(),
        ]);
    }


     /**
     * @Route("/retiro/{id}/paciente/{p}", name="retiro_edit", methods={"GET","POST"})
     */
    public function retiro(Request $request, Consulta $consultum,$p,ConsultaRepository $consultaRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $form = $this->createForm(RetiroType::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('consulta/retiro.html.twig', [
            'paciente'=>$paciente,
            'consulta' => $consultum,
            'c'=>$consultaRepository->consulta_examene($consultum->getId()),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="consulta_delate")
     * @Method({"DELETE"})
     */
    public function delete(Request $request,$id)
    {
        $consultum= $this->getDoctrine()->getRepository(Consulta::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($consultum);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

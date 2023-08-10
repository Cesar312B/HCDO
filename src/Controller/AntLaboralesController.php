<?php

namespace App\Controller;

use App\Entity\AntLaborales;
use App\Entity\Consulta;
use App\Entity\Pacientes;
use App\Form\AntLaboralesType;
use App\Repository\AntLaboralesRepository;
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
 * @Route("/ant/laborales")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class AntLaboralesController extends AbstractController
{
    /**
     * @Route("/", name="ant_laborales_index", methods={"GET"})
     */
    public function index(AntLaboralesRepository $antLaboralesRepository): Response
    {
        return $this->render('ant_laborales/index.html.twig', [
            'ant_laborales' => $antLaboralesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="ant_laborales_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository,ConsultaRepository $consultaRepository,AntLaboralesRepository $antLaboralesRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a2= $antLaboralesRepository->findBy(['pacientes'=>$paciente]);
        $antLaborale = new AntLaborales();
        $form = $this->createForm(AntLaboralesType::class, $antLaborale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $antLaborale->setPacientes($paciente);
            $antLaborale->setCreatdate(new DateTime());
            $entityManager->persist($antLaborale);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');

            return $this->redirect($request->getUri());
        }

        return $this->render('ant_laborales/new.html.twig', [
            'consulta'=>$consulta,
            'antecedentes2'=>$a2,
            'paciente'=>$paciente,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ant_laborales_show", methods={"GET"})
     */
    public function show(AntLaborales $antLaborale): Response
    {
        return $this->render('ant_laborales/show.html.twig', [
            'ant_laborale' => $antLaborale,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="ant_laborales_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AntLaborales $antLaborale,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(AntLaboralesType::class, $antLaborale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $antLaborale->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());

            
        }

        return $this->render('ant_laborales/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'ant_laborale' => $antLaborale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_labores")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(AntLaborales::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        
    }
}

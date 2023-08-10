<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Entity\OtrosAntecedentes;
use App\Entity\Pacientes;
use App\Form\OtrosAntecedentes1Type;
use App\Repository\ConsultaRepository;
use App\Repository\OtrosAntecedentesRepository;
use App\Repository\PacientesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use DateTime;

/**
 * @Route("/otros/antecedentes")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class OtrosAntecedentesController extends AbstractController
{
    /**
     * @Route("/", name="otros_antecedentes_index", methods={"GET"})
     */
    public function index(OtrosAntecedentesRepository $otrosAntecedentesRepository): Response
    {
        return $this->render('otros_antecedentes/index.html.twig', [
            'otros_antecedentes' => $otrosAntecedentesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/paciente/{id}/consulta/{c}", name="otros_antecedentes_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,$c,PacientesRepository $pacientesRepository, ConsultaRepository $consultaRepository,OtrosAntecedentesRepository $otrosAntecedentesRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($id);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $a2=$otrosAntecedentesRepository->findBy(['pacientes'=>$paciente]);
        $otrosAntecedente = new OtrosAntecedentes();
        $form = $this->createForm(OtrosAntecedentes1Type::class, $otrosAntecedente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $otrosAntecedente->setPacientes($paciente);
            $otrosAntecedente->setCreatdate(new DateTime());
            $entityManager->persist($otrosAntecedente);
            $entityManager->flush();
            $this->addFlash('exito','Registro Guardado con Éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('otros_antecedentes/new.html.twig', [
            'consulta'=>$consulta,
            'antecedentes2'=>$a2,
            'paciente'=>$paciente,
            'otros_antecedente' => $otrosAntecedente,
            'c'=>$consultaRepository->consulta_examene($consulta->getId()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="otros_antecedentes_show", methods={"GET"})
     */
    public function show(OtrosAntecedentes $otrosAntecedente): Response
    {
        return $this->render('otros_antecedentes/show.html.twig', [
            'otros_antecedente' => $otrosAntecedente,
        ]);
    }

    /**
     * @Route("/paciente/{p}/antecedente/{id}/consulta/{c}", name="otros_antecedentes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OtrosAntecedentes $otrosAntecedente,$p,$c): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paciente= $em->getRepository(Pacientes::class)->find($p);
        $consulta= $em->getRepository(Consulta::class)->find($c);
        $form = $this->createForm(OtrosAntecedentes1Type::class, $otrosAntecedente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $otrosAntecedente->setUpdatedate(new DateTime());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito','Registro Actualizado con éxito');
            return $this->redirect($request->getUri());
        }

        return $this->render('otros_antecedentes/edit.html.twig', [
            'consulta'=>$consulta,
            'paciente'=>$paciente,
            'otros_antecedente' => $otrosAntecedente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_otros")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $antecedente= $this->getDoctrine()->getRepository(OtrosAntecedentes::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($antecedente);
        $entityManager->flush();
        $response = new Response();
        $response->send();
       
    }
}

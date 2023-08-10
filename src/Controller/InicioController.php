<?php

namespace App\Controller;

use App\Repository\ConsultaRepository;
use App\Repository\DiagnosticoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class InicioController extends AbstractController
{
   

    /**
     * @Route("/welcom", name="welcom")
     * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
     */
    public function welcom(ConsultaRepository $consultaRepository,DiagnosticoRepository $diagnosticoRepository): Response
    {
            return $this->render('inicio/welcom.html.twig', [
            'controller_name' => 'InicioController',
            'consultas'=>$consultaRepository->findAll(),
           
        ]);
    }


    /**
     * @Route("/dg", name="dg")
     * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
     */
    public function diagnostico(ConsultaRepository $consultaRepository,DiagnosticoRepository $diagnosticoRepository): Response
    {
            return $this->render('inicio/analis_dg.html.twig', [
            'controller_name' => 'InicioController',
            'diagnosticos'=>$diagnosticoRepository->findAll(),
        ]);


        
    }
}
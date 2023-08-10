<?php

namespace App\Controller;

use App\Entity\Actividades;
use App\Entity\PuestoTrabajo;
use App\Form\ActividadesType;
use App\Repository\ActividadesRepository;
use App\Repository\CiudadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/actividades")
 * @IsGranted("ROLE_SUPER_ADMIN")
 */
class ActividadesController extends AbstractController
{
    /**
     * @Route("/", name="actividades_index", methods={"GET","POST"})
     */
    public function index(ActividadesRepository $actividadesRepository,Request $request): Response
    {
        $form =$this->createFormBuilder()
        ->add('file',FileType::class,[
            'label'=> 'Archivo Exel.(xlsx)',
            'mapped' => false,

               
            'required' => true,
        ])
        ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
        $file= ($form['file']->getData()); // get the file from the sent request
   
        $fileFolder = __DIR__ . '/../../exels/';  //choose the folder in which the uploaded file will be stored
  
        $filePathName= md5(uniqid()) .'.'. $file->getClientOriginalName();
      // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
            try {
                $file->move($fileFolder, $filePathName);
            } catch (FileException $e) {
                throw  new \Exception('Error al subir archivo');
            }
         $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file 
         $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
         $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
         //dd($sheetData);

         $entityManager = $this->getDoctrine()->getManager(); 
        
         foreach ($sheetData as $Row) 
             { 
     
                 $id = $Row['A']; // store the first_name on each iteration 
                 $nombre = $Row['B']; 
                 $c= $entityManager->getRepository(PuestoTrabajo::class)->find($id);
                     $m = new Actividades(); 
                     $m->setPuestoTrabajo($c);
                     $m->setActividad($nombre);
                     $entityManager->persist($m);
                     $entityManager->flush();
                     
                 
             } 
                return $this->redirect($request->getUri()); 
            }
         

        return $this->render('actividades/index.html.twig', [
            'form' => $form->createView(),
            'actividades' => $actividadesRepository->findAll(),
        ]);
    }

  

    /**
     * @Route("/puesto/{id}", name="actividades_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,ActividadesRepository $actividadesRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
     
        $puesto= $em->getRepository(PuestoTrabajo::class)->find($id);
        $actividades= $actividadesRepository->actividad_puesto($puesto->getId());
        $actividade = new Actividades();
        $form = $this->createForm(ActividadesType::class, $actividade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $actividade->setPuestoTrabajo($puesto);
            $entityManager->persist($actividade);
            $entityManager->flush();

        }

        return $this->render('actividades/new.html.twig', [
            'puesto'=>$puesto,
            'actividades' => $actividades,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actividades_show", methods={"GET"})
     */
    public function show(Actividades $actividade): Response
    {
        return $this->render('actividades/show.html.twig', [
            'actividade' => $actividade,
        ]);
    }

    /**
     * @Route("/puesto/{puesto}/edit/{id}", name="actividades_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actividades $actividade,$puesto): Response
    {
        $em= $this->getDoctrine()->getManager();
        $puesto= $em->getRepository(PuestoTrabajo::class)->find($puesto);
        $form = $this->createForm(ActividadesType::class, $actividade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        
        }

        return $this->render('actividades/edit.html.twig', [
            'puesto'=>$puesto,
            'actividade' => $actividade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_actividades")}
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $actividad= $this->getDoctrine()->getRepository(Actividades::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($actividad);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

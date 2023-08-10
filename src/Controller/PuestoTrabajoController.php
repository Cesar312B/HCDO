<?php

namespace App\Controller;

use App\Entity\PuestoTrabajo;
use App\Form\PuestoTrabajoType;
use App\Repository\PuestoTrabajoRepository;
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


/**
 * @Route("/puesto/trabajo")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class PuestoTrabajoController extends AbstractController
{
    /**
     * @Route("/", name="puesto_trabajo_index", methods={"GET","POST"})
     */
    public function index(PuestoTrabajoRepository $puestoTrabajoRepository,Request $request): Response
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
     
                 $nombre = $Row['A']; // store the first_name on each iteration 
                 $prevencion = $Row['B']; 
                     $m = new PuestoTrabajo(); 
                     $m->setNombre($nombre);
                     $m->setMedidasPreventivas($prevencion);
                     $entityManager->persist($m);
                     $entityManager->flush();
                     
                 
             } 
                return $this->redirect($request->getUri()); 
            }
         

        return $this->render('puesto_trabajo/index.html.twig', [
            'form' => $form->createView(),
            'puesto_trabajos' => $puestoTrabajoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="puesto_trabajo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $puestoTrabajo = new PuestoTrabajo();
        $form = $this->createForm(PuestoTrabajoType::class, $puestoTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($puestoTrabajo);
            $entityManager->flush();

            return $this->redirectToRoute('puesto_trabajo_index');
        }

        return $this->render('puesto_trabajo/new.html.twig', [
            'puesto_trabajo' => $puestoTrabajo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="puesto_trabajo_show", methods={"GET"})
     */
    public function show(PuestoTrabajo $puestoTrabajo): Response
    {
        return $this->render('puesto_trabajo/show.html.twig', [
            'puesto_trabajo' => $puestoTrabajo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="puesto_trabajo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PuestoTrabajo $puestoTrabajo): Response
    {
        $form = $this->createForm(PuestoTrabajoType::class, $puestoTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('puesto_trabajo_index');
        }

        return $this->render('puesto_trabajo/edit.html.twig', [
            'puesto_trabajo' => $puestoTrabajo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="puesto_trabajo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PuestoTrabajo $puestoTrabajo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$puestoTrabajo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($puestoTrabajo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('puesto_trabajo_index');
    }
}

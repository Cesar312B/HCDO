<?php

namespace App\Controller;

use App\Entity\Unidadesoperativas;
use App\Form\UnidadesoperativasType;
use App\Repository\UnidadesoperativasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/unidadesoperativas")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class UnidadesoperativasController extends AbstractController
{
    /**
     * @Route("/", name="unidadesoperativas_index", methods={"GET","POST"})
     */
    public function index(UnidadesoperativasRepository $unidadesoperativasRepository,Request $request): Response
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
     
                 $regional = $Row['A']; // store the first_name on each iteration 
                 $oficina = $Row['B']; // store the last_name on each iteration
                     $m = new Unidadesoperativas(); 
                     $m->setRegional($regional);
                     $m->setNombre($oficina);
               
                     $entityManager->persist($m);
                     $entityManager->flush();
                     
                 
             } 
                return $this->redirect($request->getUri()); 
            }
         
        return $this->render('unidadesoperativas/index.html.twig', [
            'form' => $form->createView(),
            'unidadesoperativas' => $unidadesoperativasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="unidadesoperativas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $unidadesoperativa = new Unidadesoperativas();
        $form = $this->createForm(UnidadesoperativasType::class, $unidadesoperativa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unidadesoperativa);
            $entityManager->flush();

            return $this->redirectToRoute('unidadesoperativas_index');
        }

        return $this->render('unidadesoperativas/new.html.twig', [
            'unidadesoperativa' => $unidadesoperativa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unidadesoperativas_show", methods={"GET"})
     */
    public function show(Unidadesoperativas $unidadesoperativa): Response
    {
        return $this->render('unidadesoperativas/show.html.twig', [
            'unidadesoperativa' => $unidadesoperativa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="unidadesoperativas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Unidadesoperativas $unidadesoperativa): Response
    {
        $form = $this->createForm(UnidadesoperativasType::class, $unidadesoperativa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unidadesoperativas_index');
        }

        return $this->render('unidadesoperativas/edit.html.twig', [
            'unidadesoperativa' => $unidadesoperativa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unidadesoperativas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Unidadesoperativas $unidadesoperativa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unidadesoperativa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unidadesoperativa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unidadesoperativas_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Medicamentos;
use App\Form\MedicamentosType;
use App\Repository\MedicamentosRepository;
use Doctrine\ORM\EntityManagerInterface;
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
 * @Route("/medicamentos")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class MedicamentosController extends AbstractController
{
    /**
     * @Route("/", name="medicamentos_index", methods={"GET","POST"})
     */
    public function index( MedicamentosRepository $medicamentosRepository,Request $request,EntityManagerInterface $entityManager): Response
    {
        $form =$this->createFormBuilder()
        ->add('file',FileType::class,[
            'label'=> 'Archivo Excel.(xlsx)',
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
     
                 $codigo = $Row['A']; // store the first_name on each iteration 
                 $descripcion = $Row['B']; // store the last_name on each iteration
                 $principio_activo= $Row['C']; 
                 $laboratorio= $Row['D']; 
                 $fraccion = $Row['E']; 
                 $clasificacion = $Row['F'];
                 $marca = $Row['G'];
                 $estado_producto = $Row['H'];
                 $presentacion_producto = $Row['I'];
                 $mercado = $Row['J'];
                 $iva = $Row['K'];
                 $generico = $Row['L'];
                 $portafolio_cat = $Row['M'];
                 $observaciones = $Row['N'];
                 $año = $Row['O'];
                     $m = new Medicamentos(); 
                     $m->setCodigo($codigo);
                     $m->setDescripcion($descripcion);
                     $m->setPrincipioActivo($principio_activo);
                     $m->setLaboratorio($laboratorio);
                     $m->setFraccion($fraccion);
                     $m->setClasificacion($clasificacion);
                     $m->setMarca($marca);
                     $m->setEstadoProducto($estado_producto);
                     $m->setPresentacionProducto($presentacion_producto);
                     $m->setMercado($mercado);
                     $m->setIva($iva);
                     $m->setGenerico($generico);
                     $m->setPortafolioCat($portafolio_cat);
                     $m->setObservaciones($observaciones);
                     $m->setYear($año);
                     $entityManager->persist($m);
                     $entityManager->flush();
                     
                 
             } 
                return $this->redirect($request->getUri()); 
            }




     
         
        return $this->render('medicamentos/index.html.twig', [
            'form' => $form->createView(),
            'medicamentos' => $medicamentosRepository->medicamentos(),
        ]);
    }



    /**
     * @Route("/new", name="medicamentos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicamento = new Medicamentos();
        $form = $this->createForm(MedicamentosType::class, $medicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicamento);
            $entityManager->flush();

            return $this->redirectToRoute('medicamentos_index');
        }

        return $this->render('medicamentos/new.html.twig', [
            'medicamento' => $medicamento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicamentos_show", methods={"GET"})
     */
    public function show(Medicamentos $medicamento): Response
    {
        return $this->render('medicamentos/show.html.twig', [
            'medicamento' => $medicamento,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medicamentos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medicamentos $medicamento): Response
    {
        $form = $this->createForm(MedicamentosType::class, $medicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicamentos_index');
        }

        return $this->render('medicamentos/edit.html.twig', [
            'medicamento' => $medicamento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicamentos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medicamentos $medicamento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicamento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medicamentos_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\CIE;
use App\Form\CIEType;
use App\Repository\CIERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/c/i/e")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class CIEController extends AbstractController
{
    /**
     * @Route("/", name="c_i_e_index", methods={"GET","POST"})
     */
    public function index(CIERepository $cIERepository,Request $request): Response
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
                 $codigo_tipo = $Row['C'];
                 $tipo= $Row['D']; 
                     $m = new CIE(); 
                     $m->setCodigo($codigo);
                     $m->setDescripcion($descripcion);
                     $m->setCodigoTipo($codigo_tipo);
                     $m->setTipo($tipo);
                     $entityManager->persist($m);
                     $entityManager->flush();             
             } 
                return $this->redirect($request->getUri()); 
            }
        return $this->render('cie/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/server-processing", name="server_processing_cie")
     */
    public function serverProcessing(EntityManagerInterface $entityManager)
    {
      

        /*ORDER BY sd.id DESC*/

        $dql = 'SELECT sd FROM App:CIE sd';
        $dqlCountFiltered = 'SELECT count(sd) FROM App:CIE sd';

        $sqlFilter = '';

        if (!empty($_GET['search']['value'])) {
            $strMainSearch = $_GET['search']['value'];

            $sqlFilter .= "
                sd.nombre LIKE '%".$strMainSearch."%' OR "
                ."sd.descripcion LIKE '%".$strMainSearch."%' OR "
                ."sd.codigo LIKE '%".$strMainSearch."%' OR "
                ."sd.codigo_descripcion LIKE '%".$strMainSearch."%'
                ";
        }

        // Filter columns with AND restriction
        $strColSearch = '';
        foreach ($_GET['columns'] as $column) {
            if (!empty($column['search']['value'])) {
                if (!empty($strColSearch)) {
                    $strColSearch .= ' AND ';
                }
                $strColSearch .= ' sd.'.$column['name']." LIKE '%".$column['search']['value']."%'";
            }
        }
        if (!empty($sqlFilter)) {
            $sqlFilter .= ' AND ('.$strColSearch.')';
        } else {
            $sqlFilter .= $strColSearch;
        }

        if (!empty($sqlFilter)) {
            $dql .= ' WHERE'.$sqlFilter;
            $dqlCountFiltered .= ' WHERE'.$sqlFilter;
            /*var_dump($dql);
            var_dump($dqlCountFiltered);
            exit;*/
        }

        //var_dump($dql); exit;

        $items = $entityManager
            ->createQuery($dql)
            ->setFirstResult($_GET['start'])
            ->setMaxResults($_GET['length'])
            ->getResult();

        $data = [];
        foreach ($items as  $value) {
            $data[] = [
               
                $value->getCodigo(),
                $value->getDescripcion(),
                $value->getTipo(),
                $value->getCodigoTipo()
            ];
        }

        $recordsTotal = $entityManager
            ->createQuery('SELECT count(sd) FROM App:CIE sd')
            ->getSingleScalarResult();

        $recordsFiltered = $entityManager
            ->createQuery($dqlCountFiltered)
            ->getSingleScalarResult();

        return $this->json([
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'dql' => $dql,
            'dqlCountFiltered' => $dqlCountFiltered,
        ]);
    }

    /**
     * @Route("/new", name="c_i_e_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cIE = new CIE();
        $form = $this->createForm(CIEType::class, $cIE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cIE);
            $entityManager->flush();

            return $this->redirectToRoute('c_i_e_index');
        }

        return $this->render('cie/new.html.twig', [
            'c_i_e' => $cIE,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="c_i_e_show", methods={"GET"})
     */
    public function show(CIE $cIE): Response
    {
        return $this->render('cie/show.html.twig', [
            'c_i_e' => $cIE,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="c_i_e_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CIE $cIE): Response
    {
        $form = $this->createForm(CIEType::class, $cIE);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('c_i_e_index');
        }

        return $this->render('cie/edit.html.twig', [
            'c_i_e' => $cIE,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="c_i_e_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CIE $cIE): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cIE->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cIE);
            $entityManager->flush();
        }

        return $this->redirectToRoute('c_i_e_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Ciudad;
use App\Entity\Pacientes;
use App\Entity\PuestoTrabajo;
use App\Entity\Unidadesoperativas;
use App\Form\PacientesType;
use App\Repository\PacientesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;use Doctrine\ORM\EntityManagerInterface;


/**
 * @Route("/pacientes")
 * @IsGranted("IS_AUTHENTICATED_FULLY",message="No tiene acceso a esta pagina")
 */
class PacientesController extends AbstractController
{
    /**
     * @Route("/", name="pacientes_index", methods={"GET","POST"})
     */
    public function index(PacientesRepository $pacientesRepository,Request $request): Response
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
                
                 $pnombre = $Row['A']; // store the first_name on each iteration 
                 $snombre = $Row['B']; // store the last_name on each iteration
                 $papellido= $Row['C']; 
                 $sapellido= $Row['D']; 
                 $n_identifocacion= $Row['E']; 
                 $genero= $Row['F']; 
                 $fecha_ingreso=$Row['G']; 
                
                 $estado=$Row['H']; 
                 $fecha_nacimiento=$Row['J'];
               
                 $estado_civil=$Row['K'];
                 $etnia=$Row['L'];
                 $calle_principal=$Row['M'];
                 $n_casa=$Row['N'];
                 $calle_secundaria=$Row['O'];
                 $telefono=$Row['P'];
                  $ciudad=$Row['Q']; 
                 $historia_clinica=md5(uniqid(rand(1,10), true));
                $c= $entityManager->getRepository(Ciudad::class)->find($ciudad);
                     $m = new Pacientes(); 
                     $m->setTipoIdentificacion('Cedula');
                     $m->setPnombre($pnombre);
                     $m->setSnombre($snombre);
                     $m->setPapellido($papellido);
                     $m->setSapellido($sapellido);
                     $m->setCedula($n_identifocacion);
                     $m->setIdentidadGenero($genero);
                     $m->setFechaIngreso($fecha_ingreso);
                     $m->setIsActive($estado);
                     $m->setCiudad($c);
                     $m->setFechaNacimiento($fecha_nacimiento);
                     $m->setEstadoCivil($estado_civil);
                     $m->setEtnia($etnia);
                     $m->setCallePrincipal($calle_principal);
                     $m->setNumeroCasa($n_casa);
                     $m->setCalleSecundaria($calle_secundaria);
                     $m->setCelular($telefono);
                     $m->setHistoriaClinica($historia_clinica);
                     $entityManager->persist($m);
                     $entityManager->flush();
                     
                 
             } 
                return $this->redirect($request->getUri()); 
            }
      
        return $this->render('pacientes/index.html.twig', [
            'form' => $form->createView(),
            'pacientes' => $pacientesRepository->findAll(),
            
        ]);
    }

     /**
     * @Route("/server-processing", name="server_processing")
     */
    public function serverProcessing(EntityManagerInterface $entityManager)
    {
      

        /*ORDER BY sd.id DESC*/

        $dql = 'SELECT sd FROM App:Pacientes sd';
        $dqlCountFiltered = 'SELECT count(sd) FROM App:Pacientes sd';

        $sqlFilter = '';

        if (!empty($_GET['search']['value'])) {
            $strMainSearch = $_GET['search']['value'];

            $sqlFilter .= "
                sd.id LIKE '%".$strMainSearch."%' OR "
                ."sd.cedula LIKE '%".$strMainSearch."%' OR "
                ."sd.pnombre LIKE '%".$strMainSearch."%' OR "
                ."sd.snombre LIKE '%".$strMainSearch."%' OR "
                ."sd.papellido LIKE '%".$strMainSearch."%' OR "
                ."sd.sapellido LIKE '%".$strMainSearch."%'
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
               
              
                $value->getCedula(),
                $value->getPnombre(),
                $value->getSnombre(),
                $value->getPapellido(),
                $value->getSapellido(),
                $value->getSexo(),
                $value->getFechaNacimiento(),
                $value->getFechaIngreso(),
                $value->getCiudad()->getProvincia()->getNombre(),
                $value->getCiudad()->getNombre(),
                $value->getId()
            ];
        }

        $recordsTotal = $entityManager
            ->createQuery('SELECT count(sd) FROM App:Pacientes sd')
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
     * @Route("/exel", name="exel_index", methods={"GET","POST"})
     */
    public function exel_edit(PacientesRepository $pacientesRepository,Request $request): Response
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
   
        $fileFolder = __DIR__ . '/../../public/exels/';  //choose the folder in which the uploaded file will be stored
  
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
                
                 $id_paciente = $Row['A']; // store the first_name on each iteration 
                 $id_puesto= $Row['E']; // store the last_name on each iteration
                 $tipo= $Row['F']; 
                 $m = $entityManager->getRepository(Pacientes::class)->findOneBy(array('id' => $id_paciente));
                $c= $entityManager->getRepository(PuestoTrabajo::class)->find($id_puesto);
               
        
                    $m->setPuestoTrabajo($c);
                    $m->setTipoIdentificacion($tipo);
                     $entityManager->persist($m);
                     $entityManager->flush();
                     
                 
             } 
                return $this->redirect($request->getUri()); 
            }
      
        return $this->render('pacientes/exel_edit.html.twig', [
            'form' => $form->createView(),
            'pacientes' => $pacientesRepository->findAll(),
            
        ]);
    }






      /**
     * @Route("/pacientes_d", name="pacientes_d", methods={"GET","POST"})
     */
    public function pacientes_doctor(PacientesRepository $pacientesRepository): Response
    {   
       
        $employe= $this->getUser();
        return $this->render('pacientes/pacientes_doctor.html.twig', [
            'pacientes_medico'=>$pacientesRepository->pacientes_doctor($employe->getId()),
        ]);
    }


    /**
     * @Route("/new", name="pacientes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $paciente = new Pacientes();
        $form = $this->createForm(PacientesType::class, $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file= $request->files->get('pacientes')['image'];
            if ($file) {
         
            $filname= md5(uniqid()) .'.'. $file->guessExtension();
                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('fotos_directory'),
                        $filname
                    );
                } catch (FileException $e) {
                    throw  new \Exception('Error al subir archivos');
                    // ... handle exception if something happens during file upload
                }
                  $paciente ->setImage($filname);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
               
            }
            $historia_clinica=md5(uniqid(rand(1,10), true));
            $entityManager = $this->getDoctrine()->getManager();
            $paciente->setHistoriaClinica($historia_clinica);
            $entityManager->persist($paciente);
            $entityManager->flush();

            return $this->redirectToRoute('pacientes_index');
        }

        return $this->render('pacientes/new.html.twig', [
            'paciente' => $paciente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pacientes_show", methods={"GET"})
     */
    public function show(Pacientes $paciente): Response
    {
        return $this->render('pacientes/show.html.twig', [
            'paciente' => $paciente,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="pacientes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pacientes $paciente): Response
    {
        $em= $this->getDoctrine()->getManager();
        $form = $this->createForm(PacientesType::class, $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file= $request->files->get('pacientes')['image'];
            if ($file) {
         
            $filname= md5(uniqid()) .'.'. $file->guessExtension();
                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('fotos_directory'),
                        $filname
                    );
                } catch (FileException $e) {
                    throw  new \Exception('Error al subir archivos');
                    // ... handle exception if something happens during file upload
                }
                  $paciente ->setImage($filname);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
               
            }
            $this->getDoctrine()->getManager()->flush();
            return   $this->redirect($this->generateUrl('consulta_new', array('id'=> $paciente->getId())));
      
        }

        return $this->render('pacientes/edit.html.twig', [
            'paciente' => $paciente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pacientes_delete", methods={"POST"})
     */
    public function delete(Request $request, Pacientes $paciente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paciente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paciente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pacientes_index');
    }
}

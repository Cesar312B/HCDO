<?php

namespace App\Controller;

use App\Entity\Ciudad;
use App\Entity\Provincia;
use App\Form\CiudadType;
use App\Repository\CiudadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/ciudad")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class CiudadController extends AbstractController
{
    /**
     * @Route("/", name="ciudad_index", methods={"GET"})
     */
    public function index(CiudadRepository $ciudadRepository): Response
    {
        return $this->render('ciudad/index.html.twig', [
            'ciudads' => $ciudadRepository->findAll(),
        ]);
    }

    /**
     * @Route("/provincia/{id}", name="ciudad_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,CiudadRepository $ciudadRepository): Response
    {
        $em= $this->getDoctrine()->getManager();
        $provincia= $em->getRepository(Provincia::class)->find($id);
        $ciudades= $ciudadRepository->ciudad_provincia($provincia->getId());
        $ciudad = new Ciudad();
        $form = $this->createForm(CiudadType::class, $ciudad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $ciudad->setProvincia($provincia);
            $entityManager->persist($ciudad);
            $entityManager->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('ciudad/new.html.twig', [
            'provincia'=>$provincia,
            'ciudades' => $ciudades,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ciudad_show", methods={"GET"})
     */
    public function show(Ciudad $ciudad): Response
    {
        return $this->render('ciudad/show.html.twig', [
            'ciudad' => $ciudad,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ciudad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ciudad $ciudad): Response
    {
        $form = $this->createForm(CiudadType::class, $ciudad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ciudad_index');
        }

        return $this->render('ciudad/edit.html.twig', [
            'ciudad' => $ciudad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delate_ciudad")
     * @Method({"DELETE"})
     */
    public function delete($id)
    {
        $ciudad= $this->getDoctrine()->getRepository(Ciudad::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ciudad);
        $entityManager->flush();
        $response = new Response();
        $response->send();
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function index(AuthenticationUtils $authenticationUtils,Security $security): Response
    {
       // Si el usuario ya está autenticado, redireccionar a otra página
       if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
        return $this->redirectToRoute('welcom'); // Reemplaza 'nombre_de_la_ruta' con la ruta que deseas redireccionar
    }
       
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/employed_login.html.twig', [
            'last_username' => $lastUsername,
           'error'         => $error,
        ]);
    }
}

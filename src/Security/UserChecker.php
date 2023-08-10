<?php
namespace App\Security;

use App\Entity\Employed as AppUser;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
class UserChecker implements UserCheckerInterface
{

  
    public function checkPreAuth(UserInterface $user): void
    {

     
     
        if (!$user instanceof AppUser ) {
            return;
        }

        if ($user->isIsActive() == false) {
          
            // the message passed to this exception is meant to be displayed to the user
            throw new CustomUserMessageAccountStatusException('Tu cuenta esta bloqueada.');
        }

  

        

   
    }



    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }

    
        if ($user->isIsActive() == false ) {
        
        }


    }


   
}
<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use PDO;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginFunction(Request $request, AuthenticationUtils $authUtils)
    {
      //Get error | IF THERE IS ONE
      $errorMessage = $authUtils->getLastAuthenticationError();

      //Get Last username entered
      $lastUsername = $authUtils->getLastUsername();

      if($form->isSubmitted() && $form->isValid())
      {
        
      }

      return $this->render('login/login.html.twig', array(
          'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
          'last_username' => $lastUsername,
          'error_message' => $errorMessage,
      ));
    }
}



?>

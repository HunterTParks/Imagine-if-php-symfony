<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\UserLoginType;
use AppBundle\Entity\User;
use PDO;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginFunction(Request $request)
    {
      $user = new User();
      $form = $this->createForm(UserLoginType::class, $user);

      //Get error | IF THERE IS ONE
      $authUtils = $this->get('security.authentication_utils');
      $errorMessage = $authUtils->getLastAuthenticationError();

      //Get Last username entered
      $lastUsername = $authUtils->getLastUsername();

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {

      }
      return $this->render(
          'login\login.html.twig',
          array('form' => $form->createView())
      );

    }
}



?>

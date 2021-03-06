<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\InMemoryUserProvider;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use AppBundle\Form\UserLoginType;
use AppBundle\Repository\UserRepository;
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
      $errors = $authUtils->getLastAuthenticationError();

      //Get Last username entered
      $lastUsername = $authUtils->getLastUsername();

      return $this->render('login\login.html.twig', array(
        'form' => $form->createView(),
        'errors' => $errors,
        'lastUsername' => $lastUsername
      ));

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutFunction(Request $request)
    {
      
    }
}



?>

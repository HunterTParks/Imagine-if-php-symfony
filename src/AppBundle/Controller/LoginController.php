<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\UserLoginType;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRepository;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\InMemoryUserProvider;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
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
          $userRepo = new UserRepository();
          $user = $userRepo->loadUserByUserName($form->email);
          if($user == NULL)
              return $this->render(
                  'login\login.html.twig',
                  array('form' => $form->createView())
              );

          // for some extra checks: is account enabled, locked, expired, etc.
          $userChecker = new UserChecker();

          $defaultEncoder = new MessageDigestPasswordEncoder('bcrypt', true, 500);
          $encoders = array(
              user::Class => $defaultEncoder,
          );
          $encoderFactory = new EncoderFactory($encoders);

          $provider = new DaoAuthenticationProvider(
              $user,
              $userChecker,
              'secured_area',
              $encoderFactory
          );

          $token = $provider->authenticate($unauthenticatedToken);

          if($token->isAuthenticated())
          {
              return $this->render(
                  'default\index.html.twig',
              )
          }
      }
      return $this->render(
          'login\login.html.twig',
          array('form' => $form->createView())
      );

    }
}



?>

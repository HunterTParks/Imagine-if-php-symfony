<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PDO;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginFunction(Request $request)
    {
      return $this->render('login/login.html.twig', array(
          'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
      ));
    }
}



?>

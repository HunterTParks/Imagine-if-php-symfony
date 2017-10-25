<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PDO;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/test", name="testingpage")
     */
    public function testingAction(Request $request)
    {
        return $this->render('default/testing.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/authentication", name="phpauth")
     */
     public function authenticationAction(Request $request)
     {
        $servername = "localhost:8889";
        $username = "hunter";
        $password = "hunter";

        try {
          //Create Connection
          $conn = new PDO('mysql:host=localhost:8889;dbname=cameron_database;', 'hunter', 'hunter');
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $msg = "Connection Successful";
          $config = new PHPAuth\Config($conn);
          $auth = new Auth($conn, $config);
          $email = $_GET["email"];
          $passwd = $_GET["passwd"];
          $results = $auth->login($email, $passwd);
          if(!$results['error']) {
            setcookie('authIDD', $result["hash"], $result["expire"], '/authentication');
          }
        }
        catch(PDOException $e) {
          $msg = "Connection Failed";
        }

        $conn = NULL;

        return $this->render('default/authenticationTesting.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
           'msg' => $msg,
        ));
     }

}

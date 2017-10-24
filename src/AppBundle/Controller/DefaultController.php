<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $servername = "localhost";
        $username = "hunter";
        $password = "hunter";

        //Create Connection
        $conn = mysqli_connect($servername, $username, $password);

        //Test Connection
        if(!$conn) {
            $msg = "Connection Failed: " . mysqli_connect_error();
        } else {
            $msg = "Connection Success!";
        }
        return $this->render('default/index.php', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
           'msg' => $msg,
        ));
     }

}

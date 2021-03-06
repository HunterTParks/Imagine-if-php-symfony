<?php
namespace AppBundle\Controller;

require_once __DIR__.'\..\..\..\vendor\autoload.php';
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
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
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoders = array($user);
            $encoder = new EncoderFactory($encoders);
            $passwordEncoder = new UserPasswordEncoder($encoder);

            $BCrypt = new BCryptPasswordEncoder(10);

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $BCrypt->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/guildies", name="guildies")
     */
    public function guildListAction(Request $request)
    {
        $array = $this->getDoctrine()
            ->getRepository(User::class)
            ->loadAllUsers();

        $test = NULL;
        if($array != NULL)
        {
            $test = "TEST";
        }

        $encoder = array(new jsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer, $encoder);
        $serializedArray = $serializer->serialize($array, 'json');

        return $this->render('default/guildies.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'users' => $array,
            'test' => $test,
            'serial' => $serializedArray
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

          //Enable PHPAuth and its config file
          $config = new PHPAuth\Config($conn);
          $auth = new Auth($conn, $config);

          //Get email and password
          $email = $_GET["email"];
          $passwd = $_GET["passwd"];

          //Check for authorization
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

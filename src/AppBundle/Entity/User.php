namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

class User implements UserInterface
{
    private $username;
    private $imageUrl;
    private $email;
    private $password;
}

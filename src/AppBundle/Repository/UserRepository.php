<?php
    namespace AppBundle\Repository;

    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\UserProviderInterface;
    use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
    use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
    use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
    use Doctrine\ORM\EntityRepository;
    use Doctrine\ORM\NoResultException;

    class UserRepository extends EntityRepository implements UserLoaderInterface
    {
        public function loadUserByUserName($username)
        {
            return $this->createQueryBuilder('u')
                  ->where('u.username = :username OR u.email = :email')
                  ->setParameter('username', $username)
                  ->setParameter('email', $usename)
                  ->getQuery()
                  ->getOneOrNullResult();
        }

        public function loadAllUsers()
        {
            return $this->createQueryBuilder('u')
                  ->where('u.is_active = 1')
                  ->getQuery()
                  ->getOneOrNullResult();
        }
    }
?>

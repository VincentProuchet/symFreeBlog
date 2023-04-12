<?php
namespace src\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 *
 * @author Vincent
 *        
 */
class UserRepositoy extends EntityRepository implements UserLoaderInterface
{

    /**
     *
     * @param EntityManager $em
     *            The EntityManager to use.
     * @param ClassMetadata $class
     *            The class descriptor.
     */
    public function __construct($em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    /**
     * @param string 
     * @return User or NULL
     * @see \Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface::loadUserByUsername()
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
        ->where('u.login = :login or u.email = :email')
        ->setParameter('login', $username)
        ->setParameter('email', $username)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
}


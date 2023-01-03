<?php
namespace AppBundle\Service\impl;

use AppBundle\Service\UserService;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 * @author Vincent
 *        
 */
class UserServiceImpl implements UserService
{

    private $em;

    private $userRepo;

    /**
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->userRepo = $em->getRepository(User::class);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\UserService::getUsers()
     */
    public function getUsers()
    {
        return $this->userRepo->findAll();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\UserService::getUser()
     */
    public function getUser($id)
    {
        return $this->userRepo->find($id);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\UserService::create()
     */
    public function create(User $u)
    {
        $this->validateUser($u);
        $this->em->persist($u);
        $this->em->flush($u);
        return $u;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\UserService::update()
     */
    public function update(User $u)
    {
        $this->validateUser($u);
        $existing = new User();
        $existing = $this->userRepo->find($u->getId());
        $existing->setBirth($u->getBirth());
        $existing->setFirstName($u->getFirstName());
        $existing->setName($u->getName());
        // flush sauvegarde les modification faites sur les objets
        // associés à la base de données
        $this->em->flush($existing);
        return $existing;
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\UserService::delete()
     */
    public function delete(User $u)
    {
        return $u;
    }
    
    private function validateUser(User $u){
        if(is_null($u)){
            throw new \Exception("l'utilisateur ne peux être null ");
        }
        if(is_null($u->getFirstName()) ) {
            throw new \Exception("l'utilisateur ne peux avoir un prénom null");
        }
        if(is_null($u->getName()) ) {
            throw new \Exception("l'utilisateur ne peux avoir un nom null");
        }
    }
}


<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @author Vincent
 * @ORM\MappedSuperclass
 * 
 */
class UserCredential implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="string", length=200 , unique = true , nullable  = false )
     * @var string
     */
    private $login ="";
    /**
     * @ORM\Column(type="string", length=100, unique = true, nullable = true)
     * @var string
     */
    private $username = "";    
    
    /**
     * @ORM\Column(type="string", length=100, nullable = false)
     * @var string  
     */
    private $password = "";
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $lastChanged;
    
    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $isActive = true;
    
    /**
     * 
     * @var array
     */
    private $roles = ['ROLE_ADMIN'];
    

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return \DateTime
     */
    public function getLastChanged()
    {
        return $this->lastChanged;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param \DateTime $lastChanged
     */
    public function setLastChanged($lastChanged)
    {
        $this->lastChanged = $lastChanged;
    }
    

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
        $this->password = null;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * 
     */
    public function setRoles(array $roles){
        if(count($this->role)==0){
            $this->roles = $roles;
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize([
            $this->username,
            $this->password
        ]);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->username,
            $this->password
            )= unserialize($serialized,['allowed_classes'=> false]);
    }
}


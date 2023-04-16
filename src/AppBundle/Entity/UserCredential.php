<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
/**
 * J'ai préféré séparer la classe User en deux
 * celle-ci est la superclass 
 * contenant tous le lien avec la sécurité
 * 
 * @author Vincent
 * @ORM\MappedSuperclass
 */
class UserCredential implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private $id = 0 ;
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
     * Les utilisateur peuvent avoir plusieurs roles
     * et les roles peuvent avoir plusieurs utilisateurs
     * @ORM\ManyToMany(targetEntity = "Role")
     * @ORM\JoinTable( name="users_roles",
     *           joinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="id")},
     *           inverseJoinColumns={@ORM\JoinColumn(name="role_id",referencedColumnName="id")}
     *      )
     *
     * @var Collection
     */    
    private $roles = [] ;
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }
    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
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
            $this->id,
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
            $this->id,
            $this->username,
            $this->password
            )= unserialize($serialized);
    }
}


<?php
namespace AppBundle\Entity;

use src\AppBundle\Classes\Roles;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use AppBundle\Entity\User;

/**
 * Roles de utilisateurs 
 * @author Vincent
 * @ORM\Entity
 */

class Role implements  RoleInterface,\Serializable
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private $id = 0 ;
    /**
     * @ORM\Column(type="string", length=100, unique=true, nullable = false)
     * @var string
     */
    private $label;
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getLabel()
    {
        // si le prefix'est pas au début du label on l'ajoute
        if(strpos($this->label,Roles::PREFIX)!=0){
            return Roles::PREFIX.$this->label;
        }
        return $this->label;
    }
    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    /**
     * retourne une répresentation textuelle du role ou null
     * @return string
     */
    public function getRole()
    {
        // si le prefix'est pas au début du label on l'ajoute
        if(strpos($this->label,Roles::PREFIX)!=0){
            return Roles::PREFIX.$this->label;
        }
        return $this->label;
    }
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->label
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->label
            )= unserialize($serialized);
    }

    
}


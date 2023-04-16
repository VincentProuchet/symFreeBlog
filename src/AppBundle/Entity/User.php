<?php
namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Classes\DTC;
use AppBundle\dto\UserDTO;



/**
 * Entité d'utilisateurs 
 * @author Vincent
 *@ORM\Entity
 *@ORM\InheritanceType("SINGLE_TABLE")
 *@ORM\Table(name= "users")
 */
class User extends UserCredential
{
    /**
     *
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $name = 'Itsumi';

    /**
     *
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $firstName = 'Mario';

    /**
     *
     * @ORM\Column(type ="datetime")
     * @var \DateTime
     */
    private $birth = null;
    /**
     *
     * @ORM\Column(type="string", length=200, unique=true, nullable = false)
     * @var string
     */
    private $email ="";
    

    /**
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author",fetch="EXTRA_LAZY")
     * @var Article
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

   /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     *
     * @return DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     *
     * @param DateTime $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     *
     * @param \AppBundle\Entity\Article $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     *
     * @param null|UserDTO $a
     * @return User
     */
    public static function make($a)
    {
        $o = new User();
        if ($a == null) {
            return $o;
        }
        $o->setId($a->id);
        $o->setName($a->name);
        $o->setFirstName($a->firstName);
        $o->setBirth(DTC::convertDateTime($a->birth));
        return $o;
    }
    /**
     * (non-PHPdoc)
     *
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize([
            $this->getId(),
            $this->getUsername(),
            $this->getPassword()
        ]);
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        parent::unserialize($serialized);
        list(
            
            )= unserialize($serialized);
    }

}


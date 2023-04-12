<?php
namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\dto\UserDTO;


/**
 *
 * @author Vincent
 *@ORM\Entity
 *@ORM\Table(name= "users")
 */
class User extends UserCredential
{

    /**
     *
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private $id = 0;

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
     * @return number
     */
    public function getId()
    {
        return $this->id;
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
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        $o->setBirth(DTO::convertDateTime($a->birth));
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
            $this->id,
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
            $this->id,
            )= unserialize($serialized,['allowed_classes'=> false]);
    }
    
    
}


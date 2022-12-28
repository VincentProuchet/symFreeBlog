<?php
namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * 
 * @author Vincent
 *@ORM\Entity
 *@ORM\Table(name= "users")
 */
class User
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
    private $name =  'Itsumi';
    /**
     *
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $firstName =  'Itsumi';
    /**
     *
     * @ORM\Column(type ="datetime")
     * @var \DateTime
     */
    private $birth = null;
    
    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
     * @var Article
     */
    private $articles;
    
    public function __construct(){
        $this->articles = new ArrayCollection();
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @return \AppBundle\Entity\Article
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param DateTime $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }

    /**
     * @param \AppBundle\Entity\Article $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    
}


<?php
namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;




/**
 *
 * @author Vincent
 *@ORM\Entity
 *@ORM\Table(name = "article")
 */
class Article  

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
    private $title = 'nope';

    /**
     * * @ORM\Column(type="text")
     *
     * @var string
     */
    private $text = "nothing to show";

    /**
     *
     * @ORM\Column(type ="datetime")
     * @var \Symfony\Component\Validator\Constraints\DateTime
     */
    private $creation = null;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User",inversedBy="articles")
     * @var User
     */
    private $author;

    private static $form = null;

    /**
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     *
     * @param User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * convertit le json decode en une instance de la classe Article
     * @param Mixed $a
     * @return \AppBundle\Entity\Article
     */
    public static function make($a)
    {
        $o = new Article();
        if ($a == null) {
            return $o;
        }
        $o->setId($a->id);
        $o->setText($a->text);
        $o->setTitle($a->title);
        $o->setCreation(DTO::convertDateTime($a->creation));
        $o->setAuthor(User::make($a->author));
        return $o;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     *
     * @return DateTime
     */
    public function getCreation()
    {
        return $this->creation;
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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     *
     * @param DateTime $creation
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
    }
}


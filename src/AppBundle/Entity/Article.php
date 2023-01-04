<?php
namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\dto\ArticleDTO;

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
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $title = null;

    /**
     *
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $text = null;

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
    private $author = null;

    public function __construct()
    {
        $this->creation = new \DateTime();
        $this->author = new User();
    }

    /**
     * convertit le json decode en une instance de la classe Article
     *
     * @param ArticleDTO|null $a
     * @return Article
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
    public function setAuthor(User $author)
    {
        $this->author = $author;
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


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
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id = 0;

    /**
     *
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $title =  'nope';

    /**
     * * @ORM\Column(type="text")
     *
     * @var string
     */
    private $text = "nothing to show";

    /**
     *
     * @ORM\Column(type ="datetime")
     * @var \DateTime
     */
    private $creation = null;

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


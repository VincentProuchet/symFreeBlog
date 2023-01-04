<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author Vincent
 * @ORM\Entity
 * @ORM\Table(name="app_param")
 */
class AppParam
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
     * @ORM\Column(type="string",unique = true , nullable = false , nullable = false )
     * @var string
     */
    private $name = "db_initialized";

    /**
     *
     * @ORM\Column(type="boolean", options={"default":false})
     * @var boolean
     */
    private $boolValue = false;

    /**
     *
     * @ORM\Column(type="integer", options={"default":0})
     * @var integer
     */
    private $intValue = 0;

    /**
     *
     * @ORM\Column(type="decimal")
     * @var number
     */
    private $floatValue = 0.0;

    /**
     *
     * @ORM\Column(type="text")
     * @var string
     */
    private $textValue = "";

    /**
     *
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $dateValue;

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
     * @return boolean
     */
    public function isBoolValue()
    {
        return $this->boolValue;
    }

    /**
     * @return number
     */
    public function getIntValue()
    {
        return $this->intValue;
    }

    /**
     * @return number
     */
    public function getFloatValue()
    {
        return $this->floatValue;
    }

    /**
     * @return string
     */
    public function getTextValue()
    {
        return $this->textValue;
    }

    /**
     * @return \DateTime
     */
    public function getDateValue()
    {
        return $this->dateValue;
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
     * @param boolean $boolValue
     */
    public function setBoolValue($boolValue)
    {
        $this->boolValue = $boolValue;
    }

    /**
     * @param number $intValue
     */
    public function setIntValue($intValue)
    {
        $this->intValue = $intValue;
    }

    /**
     * @param number $floatValue
     */
    public function setFloatValue($floatValue)
    {
        $this->floatValue = $floatValue;
    }

    /**
     * @param string $textValue
     */
    public function setTextValue($textValue)
    {
        $this->textValue = $textValue;
    }

    /**
     * @param \DateTime $dateValue
     */
    public function setDateValue($dateValue)
    {
        $this->dateValue = $dateValue;
    }

    /**
     */
    public function __construct()
    {}
    
}


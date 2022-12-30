<?php
namespace AppBundle\Entity;




/**
 * 
 *
 * @author Vincent
 *        
 */
class DTO
{

    private static $dateTimeFormat = "Y-m-d G:i:s.u";
    private static $dateFormat = "Y-m-d(space)H:i:s.u";
    /**
     * créer un dateTime depuis l'ojbjet donné par jsonDecode
     * @param \DateTime $a
     */
    public static function convertDateTime($a)
    {
        
        try {
            //$a = Date(DTO::$dateFormat, $a->date);
            //$a =  \DateTime::createFromFormat(DTO::$dateTimeFormat,$a->date);
            $a = \DateTimeImmutable::createFromFormat(DTO::$dateTimeFormat ,$a->date);
            return $a;
            
        } catch (\Exception $e) {
            return new \DateTime();
        }
    }
}


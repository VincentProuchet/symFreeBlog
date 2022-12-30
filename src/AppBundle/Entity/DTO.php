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

    private static $dateTimeFormat = "Y-m-d H:i:s.u";
    private static $dateFormat = "Y-m-d(space)H:i:s.u";
    private static $StoringTimezone = "UTC";
    /**
     * créer un dateTime depuis l'ojbjet donné par jsonDecode
     * @param \DateTime $a
     */
    public static function convertDateTime($a)
    {
        
        try {            
            return \DateTimeImmutable::createFromFormat(DTO::$dateTimeFormat ,$a->date,new \DateTimeZone(DTO::$StoringTimezone));            
        } catch (\Exception $e) {
            return new \DateTime();
        }
    }
}


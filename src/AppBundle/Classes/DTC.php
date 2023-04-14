<?php
namespace AppBundle\Classes;




/**
 * Date Transfert converter 
 * convertisseurs de dates entre DTO et les objets Php
 * @author Vincent
 *        
 */
class DTC
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
            return \DateTimeImmutable::createFromFormat(DTC::$dateTimeFormat ,$a->date,new \DateTimeZone(DTC::$StoringTimezone));            
        } catch (\Exception $e) {
            return new \DateTime();
        }
    }
}


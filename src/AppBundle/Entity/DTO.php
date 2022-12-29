<?php
namespace AppBundle\Entity;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * supper classe pour les DAO entity
 *
 * @author Vincent
 *        
 */
class DTO
{

    private static $dateTimeFormat = "Y-i-d(space)H:m:s.u";
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
            $a = new DateTime($a->date);
            return $a;
            
        } catch (\Exception $e) {
            return new DateTime();
        }
    }
}


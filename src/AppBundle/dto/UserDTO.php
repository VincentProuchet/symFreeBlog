<?php
namespace AppBundle\dto;

use AppBundle\Entity\User;
/**
 * Classe de transfert pour les données utilisateur
 * 
 * elle permet d'assurer que seules les données non critiques sont peuplées dans le retour à l'utilisateur
 * voir remplit avec des données volontairement fausses
 * @author Vincent
 *
 */
class UserDTO
{
    /**
     * @var integer
     */
    public $id = 0;
    
    /**
     * @var string
     */
    public $name =  'Itsumi';
    
    /**
     * @var string
     */
    public $firstName =  'Mario';
   
    /**
     * @var \DateTime
     */
    public $birth = null;
    
    /**
     * Cette fonction créer une instance de transfert des données 
     * les données transférées sont volontairement limitées pour en 
     * retirer les données critiques (ex : mots de passe)
     * @param User $u
     * @return \AppBundle\dto\UserDTO
     */
    public static function make(User $u){
        if(is_null($u)){
            return null;
        }
        $o = new UserDTO();
        $o->id = $u->getId();
        $o->firstName = $u->getFirstName();
        $o->name = $u->getName();
        $o->birth = $u->getBirth();
        return $o;
    }
    
    /**
     * Version de la fonction de création limitant les données transmises 
     * pour en retirer les données personnelles 
     * @param User|null $u
     * @return \AppBundle\dto\UserDTO
     */
    public static function makePublic($u){
        if(is_null($u)){
            return null;
        }
        $o = new UserDTO();
        $o->id = $u->getId();
        $o->firstName = $u->getFirstName();
        $o->name = $u->getName();
        return $o;
        
    }
    
}


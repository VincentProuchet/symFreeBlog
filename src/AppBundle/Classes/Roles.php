<?php
namespace src\AppBundle\Classes;

/**
 * Classe contenant les descriptions
 * oui c'est hard coded
 * oui j'aurais préféré quelque chose de configurable
 * mais ça me prendrais plusieurs mois à dévellopper.
 * @author Vincent
 *        
 */
class Roles 
{
    /** préfix pour les roles */
    const  PREFIX = 'ROLE_';
    /** roles */
    const  OWNER = 'ROLE_OWNER'
           ,ADMIN = 'ROLE_ADMIN'
           ,REDACTOR = 'ROLE_REDACTOR'
           ,MODO = 'ROLE_MODERATOR'
           ,USER = 'ROLE_USER'
           ,ANON = 'ROLE_ANON'
               ;
}


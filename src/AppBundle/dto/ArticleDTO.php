<?php
namespace AppBundle\dto;


use AppBundle\Entity\Article;

/**
 *
 * @author Vincent
 */
class ArticleDTO

{

    
    /**
     * @var integer
     */
    public $id = 0;

    /**
     * @var string
     */
    public $title ="" ;

    /**
     * @var string
     */
    public $text="";

    /**
     * @var \DateTime
     */
    public $creation = null;
    
    /**
     * @var UserDTO
     */
    public $author = null;

    /**
     * Créer une instace de la classe article avec des données publiques
     *  pour le transfert 
     * vers l'utilisateur
     * Une limitation de la fonction jsonEncode 
     * n'encode que les prorpiètées publiques d'un objet
     * 
     * @param Article $a
     * @return \AppBundle\dto\ArticleDTO
     */
    public static function make(Article $a)
    {
        $o = new ArticleDTO();
        $o->id = $a->getId();
        $o->text = $a->getText();
        $o->title = $a->getTitle();
        $o->creation = $a->getCreation();
        $o->author = UserDTO::makePublic($a->getAuthor());
        
        return $o;
    }
}


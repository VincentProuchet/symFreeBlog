<?php
namespace AppBundle\dto;


use AppBundle\Entity\Article;

/**
 *
 * @author Vincent
 */
class ArticleDTO

{

    public $id;

    public $title;

    public $text;

    public $creation;
    
    public $author;

    public static function make(Article $a)
    {
        $o = new ArticleDTO();
        $o->id = $a->getId();
        $o->text = $a->getText();
        $o->title = $a->getTitle();
        $o->creation = $a->getCreation();
        $o->author = $a->getAuthor();
        return $o;
    }
}


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

    public static function make(Article $a)
    {
        $o = new ArticleDTO();
        $o->id = $a->getId();
        $o->text = $a->getText();
        $o->title = $a->getTitle();
        $o->creation = $a->getCreation();
        return $o;
    }
}


<?php
namespace AppBundle\Service;

use AppBundle\Entity\Article;

/**
 * @author Vincent
 *
 */
interface ArticleService
{

    /**
     * retroune les dix derniers articles publiées
     * @return array
     */
    public function getLast();
    
    /**
     * retourne tous les articles
     * @return array
     */
    public function getAll();

    /**
     * retourne un article
     * @param number $id identifiant de l'article à retrouver
     * @return Article
     */
    public function getOne($id = 0);
    
    /**
     * Conrole l'intégrité des données et persiste un article dans la base de données
     * @param Article $a
     * @return Article
     */
    public function create(Article $a);
    
    /**
     * controle l'intégrité de l'article et met à jour les données de l'article
     * @param Article $a
     * @return Article
     */
    public function update(Article $a);
    
    /**
     * controle la validité de l'ordre et supprime l'article de la base de données
     * @param Article $a
     * @return Article
     */
    public function delete(Article $a);
    
    
}


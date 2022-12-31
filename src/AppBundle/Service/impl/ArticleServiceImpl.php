<?php
namespace AppBundle\Service\impl;

use AppBundle\Service\ArticleService;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 *
 * Implemémentation de la classe de service
 * pour les Entitées de type Article
 *
 * @author Vincent
 *        
 */
class ArticleServiceImpl implements ArticleService
{
    /**
     * 
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * 
     * @var string
     */
    private $articleClass = Article::class;
    /**
     * 
     * @var string
     */
    private $userClass = User::class;

    /**
     * 
     * @var ObjectRepository
     */
    private $articleRepo;
    /**
     * 
     * @var ObjectRepository
     */
    private $userRepo;

    /**
     * Constructor
     * autowwired
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->articleRepo = $entityManager->getRepository($this->articleClass);
        $this->userRepo = $entityManager->getRepository($this->userClass);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\ArticleService::getAll()
     */
    public function getAll()
    {
        return $this->articleRepo->findAll();
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\ArticleService::getOne()
     */
    public function getOne($id = 0)
    {
        return $this->articleRepo->find($id);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\ArticleService::create()
     */
    public function create(Article $a)
    {
        $existing = $this->articleRepo->find($a->getId());
        // on verifie qu'il n'existe pas déjà un même identifiant
        if (! is_null($existing)) {
            // on est censé lancer une erreur ici
            return $a;
        }
        // on lui colle la date de maintenant
        $a->setCreation(new \DateTime());
        // en toute logique on devrait aussi lui coller l'utilisateur connecté
        $a->setAuthor($this->getUser($a));
        // on est aussi censer vérifier l'intégritée des données
        $this->validArticle($a);
        $this->em->persist($a);
        $this->em->flush($a);
        return $a;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\ArticleService::update()
     */
    public function update(Article $a)
    {   
        $existing = $this->articleRepo->find($a->getId());
        $existing->setTitle($a->getTitle());
        $existing->setText($a->getText());    
        // controle 'intégrité des données
        $this->validArticle($existing);
        // flush sauvegarde les modification faites sur les objets 
        // associés à la base de données
        $this->em->flush($existing);
        return $existing;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\ArticleService::getLast()
     */
    public function getLast()
    {
        
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\ArticleService::delete()
     */
    public function delete(Article $a)
    {
        $existing = $this->articleRepo->find($a->getId());
        $this->em->remove($existing);
        $this->em->flush();
        return $existing;
    }

    /**
     * vérifie l'intégritée des données d'un article
     * devrais lancer une exception
     *
     * @param Article $a
     */
    private function validArticle(Article $a)
    {
        if (is_null($a->getTitle())) {
            return false;
        }
        if (is_null($a->getText())) {
            return false;
        }
    }

    private function getUser(Article $article)
    {
        $user = $this->em->find(User::class, $article->getAuthor()
            ->getId());
        if (is_null($user)) {
            // throw exception
        }
        return $user;
    }
}


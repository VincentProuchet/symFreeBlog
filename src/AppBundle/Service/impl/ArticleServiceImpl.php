<?php
namespace AppBundle\Service\impl;

use AppBundle\Service\ArticleService;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityNotFoundException;

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
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->articleRepo = $entityManager->getRepository(Article::class);
        $this->userRepo = $entityManager->getRepository(User::class);
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
        $response = $this->articleRepo->find($id);
        if (is_null($response)) {
            throw new EntityNotFoundException("Article non trouvé");
        }
        return $response;
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
        $existing = $this->getOne($a->getId());
        // controle l'intégrité des données
        // il faut le faire avant toutes altération d'une entitées déjà persisté
        // sinon le prochain flush risquerait de valider de mauvaises données
        $this->validArticle($a);
        
        $existing->setTitle($a->getTitle());
        $existing->setText($a->getText());
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
    {}

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
            throw new \Exception("l'article na pas de titre");
        }
        if (is_null($a->getText())) {
            throw new \Exception("l'article na pas de texte");
        }
    }

    private function getUser(Article $article)
    {
        $user = $this->em->find(User::class, $article->getAuthor()
            ->getId());
        if (is_null($user)) {
            throw new \Exception("l'article doit avoir un autheur");
        }
        return $user;
    }
}


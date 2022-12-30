<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\dto\ArticleDTO;
use AppBundle\Form\ArticleType;
use AppBundle\Form\UserType;
use AppBundle\dto\UserDTO;

class ArticleControler extends Controller
{

    /**
     *
     * @Route("/article" , methods={"GET"})
     */
    public function getAll()
    {
        $em = $this->getDoctrine()->getManagerForClass(Article::class);
        $data = $em->find(Article::class, 72);
        if ($data != null) {
            return $this->json(ArticleDTO::make($data));
        }
        return $this->json($data);
    }

    /**
     *
     *      @Route(
     *          "/article/{id}"
     *          ,methods={"GET"}
     *          ,name="one_article"
     *          ,requirements={
     *            "id"="\d+"
     *          }
     *      )
     */
    public function getOne($id, Request $request)
    {
        $em = $this->getDoctrine()->getManagerForClass(Article::class);
        $data = $em->find(Article::class, $id);
        if ($data == null) {
            $data = new Article();
        }
        return $this->json(ArticleDTO::make($data));
    }

    /**
     *
     * @Route("/article", methods={"PUT"})
     */
    public function create(Request $request)
    {
        // on récupére l'entitity Manager
        $em = $this->getDoctrine()->getManager();
        $article = new Article();
        $user = null;
        $now = new \DateTime();
        $article = Article::make(json_decode($request->getContent(), false));
        $existing = $em->find(Article::class, $article->getId());
        // si l'article existe déjà
        if ($existing != null) {
            return $this->json(ArticleDTO::make($existing), 405);
        }
        $user = $em->find(User::class, $article->getAuthor()
            ->getId());

        $article->setAuthor($user);

        $article->setCreation($now);
        $em->persist($article);
        $em->flush();
        return $this->json(ArticleDTO::make($article), 201);
    }

    /**
     *
     * @Route("/article", methods={"PATCH"})
     */
    public function modify(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = new Article();
        $article = Article::make(json_decode($request->getContent(), false));
        $existing = $em->find(Article::class, $article->getId());
        // si l'article n'existe pas déjà
        if (is_null($existing)) {
            // nvoyer une erreur
            return $this->json(ArticleDTO::make($article), 404);
        }
        $user = $em->find(User::class, $article->getAuthor()
            ->getId());
        
        //return $this->json(UserDTO::make($user), 404);
        
        $article->setAuthor($user);
                     
        $existing->setTitle($article->getTitle());
        $existing->setText($article->getText());
        $existing->setAuthor($user);
        
        
        
        
        $em->persist($existing);
        $em->flush();
        return $this->json(ArticleDTO::make($existing), 200);
    }

    /**
     *
     * @Route("/article", methods={"DELETE"})
     */
    public function delete(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = new Article();
        $article = Article::make(json_decode($request->getContent(), false));
        $existing = $em->find(Article::class, $article->getId());
        // si l'article n'existe pas déjà
        if (is_null($existing)) {
            // nvoyer une erreur
            return $this->json(ArticleDTO::make($article), 404);
        }
        
        $em->remove($existing);
        $em->flush();
        return $this->json(ArticleDTO::make($existing), 200);
    }
}


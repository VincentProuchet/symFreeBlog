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

class ArticleControler extends Controller
{

    /**
     *
     * @Route("/article" , methods={"GET"})
     */
    public function getAll()
    {
        $data = [
            ArticleDTO::make(new Article()),
            ArticleDTO::make(new Article()),
            ArticleDTO::make(new Article()),
            ArticleDTO::make(new Article()),
            ArticleDTO::make(new Article())
        ];
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
        $data =  $em->find(Article::class, $id);        
        if($data== null){
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
        $existing =  $em->find(Article::class, $article->getId());
        // si l'article existe déjà
        if($existing!= null){
            return $this->json(ArticleDTO::make($existing), 405);
        }
        $user = $em->find(User::class,$article->getAuthor()->getId());
        
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
        $article = new Article();
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ArticleType::class, $article);
        $form->submit($data);

        return $this->json(ArticleDTO::make($article), 201);
    }

    /**
     *
     * @Route("/article", methods={"DELETE"})
     */
    public function delete(Request $request)
    {
        $article = new Article();
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ArticleType::class, $article);
        $form->submit($data);

        return $this->json(ArticleDTO::make($article), 201);
    }
}


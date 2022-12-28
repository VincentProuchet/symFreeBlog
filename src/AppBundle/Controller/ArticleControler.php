<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\dto\ArticleDTO;
use AppBundle\Form\ArticleType;

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
        $data = new Article();
        $data->setId($id);
        $data->setText("get one give you a one and only one article JSON object");
        $data->setTitle("a nice title");
        $data->setCreation(\DateTime::createFromFormat("Y-m-d", "2022-10-28"));
        
        
        return $this->json(ArticleDTO::make($data));
    }

    /**
     *
     * @Route("/article", methods={"PUT"})
     */
    public function create(Request $request)
    {
        // on récupére l'entitity Manager
        $em = $this->getDoctrine()->getManagerForClass(Article::class);
        $article = new Article();
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(ArticleType::class, $article);
        $form->submit($data);
        $em->persist($article);
       //$em->flush();
                    
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


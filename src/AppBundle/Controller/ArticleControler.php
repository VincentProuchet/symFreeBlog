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
use AppBundle\Service\ArticleService;

/**
 *
 * @author Vincent
 *        
 */
class ArticleControler extends Controller
{

    /**
     *
     * @var ArticleService
     */
    private $articleService;

    /**
     *
     * @param ArticleService $srvArticle
     */
    public function __construct(ArticleService $srvArticle)
    {
        $this->articleService = $srvArticle;
    }

    /**
     *
     * @Route("/article" , methods={"GET"})
     */
    public function getAll()
    {
        $data = $this->articleService->getAll();
        if (is_null($data)) {
            return $this->json(new ArticleDTO(), 404);
        }
        $articleDTO = [];
        foreach ($data as $value) {
            array_push($articleDTO, ArticleDTO::make($value));
        }
        return $this->json($articleDTO);
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
        $data = $this->articleService->getOne($id);
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
        // transformation du body en objet
        $article = Article::make(json_decode($request->getContent(), false));
        $article = $this->articleService->create($article);
        return $this->json(ArticleDTO::make($article), 201);
    }

    /**
     *
     * @Route("/article", methods={"PATCH"})
     */
    public function modify(Request $request)
    {
        $response = "";
        $status = 200;
        try {
            $article = Article::make(json_decode($request->getContent(), false));
            $article = $this->articleService->update($article);
            $response = ArticleDTO::make($article);
        } catch (\Exception $e) {
            $response = $e;
            $status = 404;
        }
        return $this->json($response, $status);
    }

    /**
     *
     * @Route("/article", methods={"DELETE"})
     */
    public function delete(Request $request)
    {
        $article = Article::make(json_decode($request->getContent(), false));
        $article = $this->articleService->delete($article);
        return $this->json(ArticleDTO::make($article), 200);
    }
}


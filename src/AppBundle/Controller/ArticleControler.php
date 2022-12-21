<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\dto\ArticleDTO;

class ArticleControler extends Controller
{
    /**
     * @Route("/article" , methods={"GET"})
     */
    public function getAll(){
        $data = [ArticleDTO::make(new Article()),ArticleDTO::make(new Article()),ArticleDTO::make(new Article()),ArticleDTO::make(new Article()),ArticleDTO::make(new Article())];
        return $this->json($data);
    }
    /**

      @Route(
          "/article/{id}"
          ,methods={"GET"}
          ,name="one_article"
          ,requirements={
            "id"="\d+"
          }
      )
     */
    public function getOne($id,Request $request){
        $data = new Article();
        $data->setId($id);
        $data->setText("get one give you a one and only one article JSON object");
        $data->setTitle("a nice title");
        $data->setCreation(\DateTime::createFromFormat("Y-m-d", "2022-10-28"));
        
        return $this->json(ArticleDTO::make($data));
    }
    /**
     * @Route("/article", methods={"PUT"})
     */
    public function create(Request $request){
        $data = new Article();
        $data->setTitle("the put controler");
        $data->setCreation(new \DateTime());
        return $this->json(ArticleDTO::make($data));
        
    }
    /**
     * @Route("/article", methods={"PATCH"})
     */
    public function modify(Request $request){
        $data = new Article();
        $data->setTitle("the patch controler");
        $data->setCreation(new \DateTime());
        return $this->json(ArticleDTO::make($data));
    }
    /**
     * @Route("/article", methods={"DELETE"})
     */
    public function delete(Request $request){
        $data = new Article();
        $data->setTitle("the delete controler");
        $data->setCreation(new \DateTime());
        return $this->json(ArticleDTO::make($data));
    }
    
}


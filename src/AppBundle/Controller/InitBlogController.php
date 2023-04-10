<?php
namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Tools\SchemaTool;
use AppBundle\Entity\User;
use AppBundle\Entity\Article;
use AppBundle\Entity\AppParam;
use Utility;
use Doctrine\ORM\Tools\SchemaValidator;


/**
 *
 * @author Vincent
 *        
 */
class InitBlogController extends Controller
{

    private static $blogClasses = [];

    /**
     */
    public function __construct()
    {
        self::$blogClasses = [
            new AppParam(),
            new User(),
            new Article(),
        ];
        
        
        
    }

/**
 * 
 * @Route("/admin/install" , methods={"GET"})
 * @return \Symfony\Component\HttpFoundation\Response
 */
    public function installBlog()
    {
        // getting entity manager
        $em = $this->getDoctrine()->getManager();
        $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
            'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
            'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
        ));
        $classes = array(
            $em->getClassMetadata('AppBundle\Entity\User'),
            $em->getClassMetadata('AppBundle\Entity\Article'),
            $em->getClassMetadata('AppBundle\Entity\AppParam')
        );
        
        $validator = new SchemaValidator($em);
        $errors = $validator->validateMapping();
        
        // getting schema tool
        $tool = new SchemaTool($em);
     
        $tool->updateSchema(InitBlogController::$blogClasses, false);
        
        
        return $this->render('default/aboutme.html.twig', [
            //'base_dir' => realpathV($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'base_dir' =>  Utility\FFF::realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}


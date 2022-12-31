<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Utility\FFF;



class DefaultController extends Controller
{
    /**
     * 
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            //'base_dir' => realpathV($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'base_dir' => FFF::realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/",name="about")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutme(Request $request){
        // replace this example code with whatever you need
        return $this->render('default/aboutme.html.twig', [
            //'base_dir' => realpathV($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'base_dir' => FFF::realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
   
}

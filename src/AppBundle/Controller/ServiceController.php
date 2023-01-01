<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Utility\FFF;
/**
 * 
 * @author Vincent
 *@deprecated
 */
class ServiceController extends Controller
{
    /**
     * @Route("/serviceinfo", name = "phpInfo")
     * @param Request $request
     */
    public function serviceInfo(Request $request){
        return $this->render('default/serviceinfo.twig', [
            //'base_dir' => realpathV($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'base_dir' => FFF::realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'info' => phpinfo()
        ]);
    }
    
}


<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityNotFoundException;
use AppBundle\Service\AppParamService;
use AppBundle\Entity\AppParam;
use Symfony\Component\Debug\Exception\FatalErrorException;

/**
 *
 * @author Vincent
 *        
 */
class BlogController extends Controller
{

    private static $DB_initilized = null;
    
    private $paramService;

    /**
     */
    public function __construct(AppParamService $srvAppParam)
    {
        
        
        $paramInit = new AppParam();
        $this->paramService = $srvAppParam;
        if (is_null(self::$DB_initilized)) {
            try {
                // on essaie de récupérer le paramètre init de la base de donnée
                $paramInit = $srvAppParam->getParam(AppParam::init);
            } // en cas d'echec parce que le paramètre n'existe pas
            catch (EntityNotFoundException $e) {
                $paramInit = $this->initEntities();
            } 
            // en cas d'autres erreurs
            // comme l'erreur de connection à la base de données
            catch (FatalErrorException $e) {
                // on est censé re-router vers le controleur d'initialisation du blog
                // pour faire la procédure d'entrée des paramétres du service
            }
            if (! $paramInit->isBoolValue()) {
                $this->killDB();
            }
            self::$DB_initilized = $paramInit;
        }
        
    }

    private function initDB()
    {
        $initParam = new AppParam();
        return $initParam;
    }

    private function killDB()
    {}
}


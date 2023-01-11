<?php
namespace Utility;

use Symfony\Component\Validator\Constraints\IsNull;

/**
 *
 * @author Vincent
 *        
 */
class DebugLoad
{

    /**
     * dossier racine du site
     * necessaire pour que les require puissent avoir un chemin complet
     *
     * @var string
     */
    private static $root = "";

    /**
     * répertoir debug de symfony
     *
     * @var string
     */
    const dir_Symfony_debug = "../vendor/symfony/symfony/src/Symfony/Component/Debug/";

    /**
     * sous-répertoir Exception
     *
     * @var string
     */
    const dir_exception = 'Exception/';

    /**
     * sous-erépertoire des error handlers
     *
     * @var string
     */
    const dir_errorHandler = 'FatalErrorHandler/';

    /**
     * nom du fichier exception hndler
     *
     * @var string
     */
    const exceptionHandler = "ExceptionHandler";

    /**
     * nom des
     * fichiers de classes d'excecption
     *
     * @var array
     */
    const exceptions = [
        "FlattenException",
        "FatalErrorException",
        "ContextErrorException",
        "ClassNotFoundException",
        "FatalErrorException"
    ];

    /**
     * noms des
     * fichiers de classe handler
     *
     * @var array
     */
    const fatalErrorHandlers = [
        "FatalErrorHandlerInterface",
        "UndefinedFunctionFatalErrorHandler",
        "UndefinedMethodFatalErrorHandler",
        "ClassNotFoundFatalErrorHandler"
    ];

    /**
     * setter pour le root du site
     * il est fortement recommandé de donnéer le dossier racine du site
     * pour que les importation de fichier se fassent correctement
     *
     * @param string $dir
     */
    public static function setRoot($dir = null)
    {
        if (! is_null($dir)) {
            self::$root = $dir;
        }
    }

    /**
     * charge les classes d'exception
     * contenue dans le tableau exceptions
     *
     * @param string $root
     */
    public static function loadExceptionsClass()
    {
        self::LoadExceptionHandler();
        foreach (self::exceptions as $value) {
            require_once self::$root . self::dir_Symfony_debug . self::dir_exception . $value . ".php";
            ;
        }
    }

    /**
     * charge la classe exception handler
     *
     * @param string $root
     */
    private static function LoadExceptionHandler()
    {
        require_once self::$root . self::dir_Symfony_debug . self::exceptionHandler . ".php";
    }

    /**
     * Charge les classe Error handler
     *
     * @param string $root
     */
    public static function loadErrorHandlersClass()
    {
        foreach (self::fatalErrorHandlers as $value) {
            require_once self::$root . self::dir_Symfony_debug . self::dir_errorHandler . $value . ".php";
            ;
        }
    }

    public static function loadAll($root = null)
    {
        self::setRoot($root);
        self::LoadExceptionHandler();
        self::loadExceptionsClass();
        self::loadErrorHandlersClass();
    }
}


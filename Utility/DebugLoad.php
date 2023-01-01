<?php
namespace Utility;

/**
 *
 * @author Vincent
 *        
 */
class DebugLoad
{
    private static $root = "";

    const dir_Symfony_debug = "/vendor/symfony/symfony/src/Symfony/Component/Debug/";

    const dir_exception = 'Exception/';

    const dir_fatalerrorHandler = 'FatalErrorHandler/';

    const exceptionHandler = "ExceptionHandler";

    const exceptions = [
        "FlattenException",
        "FatalErrorException",
        "ContextErrorException",
        "ClassNotFoundException",
        "FatalErrorException"
    ];

    const fatalErrorHandlers = [
        "FatalErrorHandlerInterface",
        "UndefinedFunctionFatalErrorHandler",
        "UndefinedMethodFatalErrorHandler",
        "ClassNotFoundFatalErrorHandler"
    ];
    
    
    public static function setRoot($dir){
        DebugLoad::$root = $dir;
    }

    public static function loadExceptionsClass()
    {
        
        DebugLoad::LoadExceptionHandler();
        foreach (DebugLoad::exceptions as $value) {
            require_once DebugLoad::$root. DebugLoad::dir_Symfony_debug . DebugLoad::dir_exception . $value . ".php";
            ;
        }
    }

    private static function LoadExceptionHandler()
    {
        require_once DebugLoad::$root. DebugLoad::dir_Symfony_debug . DebugLoad::exceptionHandler . ".php";
    }

    public static function loadErrorHandlersClass(){
        foreach (DebugLoad::fatalErrorHandlers as $value) {
            require_once DebugLoad::$root. DebugLoad::dir_Symfony_debug . DebugLoad::dir_fatalerrorHandler . $value . ".php";
            ;
        }
    }
    
}


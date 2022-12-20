<?php

// Class injection 
// ils sont là pour vous permettre de voir les erreurs levées par symfony
// parce que l'autoloader des classes échoue si le framework n'est pas totalement initialisé

$symfony_debug_dir ="vendor\\symfony\\symfony\\src\\Symfony\\Component\Debug\\";
$symfony_exception_dir = $symfony_debug_dir.'Exception\\';
$symfony_fatalerrorHandler_dir = $symfony_debug_dir.'FatalErrorHandler\\';

require_once $symfony_debug_dir.'ExceptionHandler.php';


require_once $symfony_exception_dir.'FlattenException.php';
require_once $symfony_exception_dir.'FatalErrorException.php';
require_once $symfony_exception_dir.'ContextErrorException.php';
require_once $symfony_exception_dir.'ClassNotFoundException.php';
require_once $symfony_exception_dir.'FatalErrorException.php';
 
require_once  $symfony_fatalerrorHandler_dir.'FatalErrorHandlerInterface.php';
require_once  $symfony_fatalerrorHandler_dir.'UndefinedFunctionFatalErrorHandler.php';
require_once  $symfony_fatalerrorHandler_dir.'\UndefinedMethodFatalErrorHandler.php';
require_once  $symfony_fatalerrorHandler_dir.'ClassNotFoundFatalErrorHandler.php';
// Fonction de substitution
// remplace les fonctions désactivées du serveur
// utilisez un search and replace
// lorsque vous aurez une erreur  invalid argument 
// faite le search and replace de umask par umaskV 
// pour une raison inconnue sont erreur n'indique pas qu'il est désactivé
// lorsque vous les aurez toutes remplacées 
// vous devriez avoir la page d'acceuil par défaut du framework

 function realpathV($path)
{
    // Cleaning path regarding OS
    $path = mb_ereg_replace('\\\\|/', DIRECTORY_SEPARATOR, $path, 'msr');
    // Check if path start with a separator (UNIX)
    $startWithSeparator = $path[0] === DIRECTORY_SEPARATOR;
    $matches= '';
    // Check if start with drive letter
    preg_match('/^[a-z]:/', $path, $matches);
    $startWithLetterDir = isset($matches[0]) ? $matches[0] : false;
    // Get and filter empty sub paths
    $subPaths = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'mb_strlen');
    
    $absolutes = [];
    foreach ($subPaths as $subPath) {
        if ('.' === $subPath) {
            continue;
        }
        // if $startWithSeparator is false
        // and $startWithLetterDir
        // and (absolutes is empty or all previous values are ..)
        // save absolute cause that's a relative and we can't deal with that and just forget that we want go up
        if ('..' === $subPath
            && !$startWithSeparator
            && !$startWithLetterDir
            && empty(array_filter($absolutes, function ($value) { return !('..' === $value); }))
            ) {
                $absolutes[] = $subPath;
                continue;
            }
            if ('..' === $subPath) {
                array_pop($absolutes);
                continue;
            }
            $absolutes[] = $subPath;
    }
    
    return
    (($startWithSeparator ? DIRECTORY_SEPARATOR : $startWithLetterDir) ?
        $startWithLetterDir.DIRECTORY_SEPARATOR : ''
        ).implode(DIRECTORY_SEPARATOR, $absolutes);
}

function putenvV($var){
    $args = explode('=', $var, 2 );
    
    $_ENV[$args[0]]= $args[1];
}
function ini_setV($varname, $newvalue){
    return ini_get($varname); 
}

function setlocaleV($category, $locale){
    return false;
}
function umaskV($mask=null){
    return 0;
}

include 'web/app_dev.php';
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
// faite le search and replace de umask par umask 
// pour une raison inconnue sont erreur n'indique pas qu'il est désactivé
// lorsque vous les aurez toutes remplacées 
// vous devriez avoir la page d'acceuil par défaut du framework

//require_once 'bin/FreeForbidenFunctions.php';

include 'web/app_dev.php';
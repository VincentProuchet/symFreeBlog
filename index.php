<?php

    
use Utility\DebugLoad;

define(LOG_PID, 1);
    

// Class injection 
// ils sont là pour vous permettre de voir les erreurs levées par symfony
// parce que l'autoloader des classes échoue si le framework n'est pas totalement initialisé

$utility_dir =dirname(__FILE__)."/Utility/";

// classe contenant les fonctions de substitution
require_once $utility_dir."FFF.php" ;
// classe de chargemetn des Exceptions
require_once $utility_dir.'DebugLoad.php';

DebugLoad::setRoot(dirname(__FILE__));
DebugLoad::loadExceptionsClass();
DebugLoad::loadErrorHandlersClass();

include 'web/app_dev.php';
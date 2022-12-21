<?php
/**
 * Fonctions de substitution
 * remplace les fonctions désactivées du serveur
 * 
 * utilisez un search and replace
 * lorsque vous aurez une erreur  invalid argument
 * faites le search and replace de umask par umaskV
 * pour une raison inconnue son erreur n'indique pas qu'il est désactivé
 * 
 * lorsque vous les aurez toutes remplacées
 * vous devriez avoir la page d'acceuil par défaut du framework
 * 
 * @author ProuchetVincent
 */




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
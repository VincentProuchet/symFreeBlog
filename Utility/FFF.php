<?php
namespace Utility;
/**
 * Free forbiden functions
 * 
 * CLASSE de substitution de fonctions
 * remplace les fonctions désactivées par le fournisseur de service
 *
 * utilisez un search and replace
 * pour placer chaque fonctions de l'objet 
 * à la place de la fonciton de php
 *
 * les noms sont identitques
 * 
 * lorsque vous aurez une erreur  invalid argument
 * faites le search and replace de umask par FFF::umask
 * pour une raison inconnue son erreur n'indique pas qu'il est désactivé
 *
 * lorsque vous les aurez toutes remplacées
 * vous devriez avoir la page d'acceuil par défaut du framework
 *
 * @author ProuchetVincent
 */
class FFF
{

    /**
     * Mode de fonctionnement de l'objet statique
     *
     * @var string
     */
    public static $MODE = self::MODE_FREE;

    const MODE_NORMAL = "NORMAL";

    const MODE_FREE = "FREE";

    /**
     * obfusque la fonction realpath d'origine de php
     * pour la remplacer par une fonction exécutant
     * un traitement équivalent à la fonction d'origine
     *
     * @param string $path
     * @return string
     */
    public static function realpath($path)
    {
        switch (FFF::$MODE) {
            case FFF::MODE_FREE:
                return FFF::realpathV($path);
                break;
            default:
                return realpath($path);
        }
    }

   
    /**
     *
     * @param mixed $var
     */
    public static function putenv($var)
    {
        switch (FFF::$MODE) {
            case FFF::MODE_FREE:
                $args = explode('=', $var, 2);
                $_ENV[$args[0]] = $args[1];
                break;
            default:
                return putenv($var);
        }
    }

    /**
     *
     * @param string $varname
     * @param string $newvalue
     * @return string
     */
    public static function ini_set($varname, $newvalue)
    {
        switch (FFF::$MODE) {
            case FFF::MODE_FREE:
                return ini_get($varname);
                break;
            default:
                return ini_set($varname, $newvalue);
        }
    }

    /**
     *
     * @param string $category
     * @param string $locale
     * @return boolean
     */
    public static function setlocale($category, $locale)
    {
        switch (FFF::$MODE) {
            case FFF::MODE_FREE:
                return false;
                break;
            default:
                return setlocale($category, $locale);
        }
    }

    /**
     *
     * @param number $mask
     * @return number
     */
    public static function umask($mask = null)
    {
        switch (FFF::$MODE) {
            case FFF::MODE_FREE:
                return 0;
                break;
            default:
                return umask($mask);
        }
    }

    /**
     *
     * @param string $directory
     * @param mixed $context
     * @return boolean
     */
    public static function rmdir($directory, $context = null)
    {
        switch (FFF::$MODE) {
            case FFF::MODE_FREE:
                return false;
                break;
            default:
                return rmdir($directory, $context);
        }
    }
    /**
     * Custom realpath
     * j'y mis les traitement ici
     * pour garder la fonction de tri la plus simple possible
     *
     * @param string $path
     * @return string
     */
    private static function realpathV($path)
    {
        // Cleaning path regarding OS
        $path = mb_ereg_replace('\\\\|/', DIRECTORY_SEPARATOR, $path, 'msr');
        // Check if path start with a separator (UNIX)
        $startWithSeparator = $path[0] === DIRECTORY_SEPARATOR;
        $matches = '';
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
            if ('..' === $subPath && ! $startWithSeparator && ! $startWithLetterDir && empty(array_filter($absolutes, function ($value) {
                return ! ('..' === $value);
            }))) {
                $absolutes[] = $subPath;
                continue;
            }
            if ('..' === $subPath) {
                array_pop($absolutes);
                continue;
            }
            $absolutes[] = $subPath;
        }
        
        return (($startWithSeparator ? DIRECTORY_SEPARATOR : $startWithLetterDir) ? $startWithLetterDir . DIRECTORY_SEPARATOR : '') . implode(DIRECTORY_SEPARATOR, $absolutes);
    }
    
}


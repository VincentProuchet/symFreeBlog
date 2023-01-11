<?php
namespace Utility;

use Symfony\Component\DomCrawler\Image;

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
 * lorsque vous aurez une erreur invalid argument
 * faites le search and replace de umask par self::umask
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
    public static function realpath(&$path)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return self::realpathV($path);
                break;
            default:
                return realpath($path);
        }
    }

    /**
     *
     * @param mixed $var
     */
    public static function putenv(&$var)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
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
    public static function ini_set(&$varname, &$newvalue)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
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
    public static function setlocale(&$category, &$locale, &$_ = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return setlocale($category, $locale, $_);
        }
    }

    /**
     *
     * @param number $mask
     * @return number
     */
    public static function umask(&$mask = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
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
    public static function rmdir(&$directory, &$context = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return rmdir($directory, $context);
        }
    }

    /**
     *
     * @param number $seconds
     * @return boolean
     */
    public static function set_time_limit(&$seconds = 0)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return true;
                break;
            default:
                return set_time_limit($seconds);
        }
    }

    /**
     *
     * @return string
     */
    public static function get_current_user()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return "anonyme";
                break;
            default:
                return get_current_user();
        }
    }

    /**
     *
     * @param string $mode
     * @return string
     */
    public static function php_uname(&$mode = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return "";
                break;
            default:
                return php_uname($mode);
        }
    }

    /**
     *
     * @return number
     */
    public static function getmyuid()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return 1;
                break;
            default:
                return getmyuid();
        }
    }

    /**
     *
     * @return number
     */
    public static function getmypid()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return 1;
                break;
            default:
                return getmypid();
        }
    }

    /**
     *
     * @param string $library
     * @return boolean
     */
    public static function dl(&$library = "")
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return dl($library);
        }
    }

    /**
     *
     * @param string $varname
     * @param string $newvalue
     */
    public static function ini_alter(&$varname, &$newvalue)
    {
        self::ini_set($varname, $newvalue);
    }

    /**
     *
     * @param string $varname
     */
    public static function ini_restore(&$varname)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                break;
            default:
                ini_restore($varname);
        }
    }

    /**
     *
     * @return boolean|resource
     */
    public static function tmpfile()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return tmpfile();
        }
    }

    /**
     *
     * @param string $target
     * @param string $link
     * @return boolean
     */
    public static function link(&$target,&$link)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return link($target, $link);
        }
    }

    /**
     *
     * @param string $cmd
     * @return boolean|string
     */
    public static function shell_exec(&$cmd)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return "";
                break;
            default:
                return shell_exec($cmd);
        }
    }

  
    /**
     * @param string $cmd
     * @param array $descriptorspec
     * @param array $pipes
     * @param string $cwd
     * @param array $env
     * @param array $other_options
     * @return boolean|resource
     */
    public static function proc_open(&$cmd, array &$descriptorspec, array &$pipes, &$cwd = null, array &$env = null, array &$other_options = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return proc_open($cmd, $descriptorspec, $pipes, $cwd , $env , $other_options );
        }
    }

    /**
     *
     * @return string|mixed
     */
    public static function chroot()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return "";
                break;
            default:
                return chroot();
        }
    }

    /**
     *
     * @param number $seconds
     * @return number
     */
    public static function sleep(&$seconds = 0)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return 0;
                break;
            default:
                return sleep($seconds);
        }
    }

    /**
     *
     * @param int $micro_seconds
     */
    public static function usleep(&$micro_seconds)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return;
                break;
            default:
                usleep($micro_seconds);
        }
    }

    /**
     *
     * @param string $new_include_path
     * @return boolean|string
     */
    public static function set_include_path(&$new_include_path)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return set_include_path($new_include_path);
        }
    }

    /**
     */
    public static function restore_include_path()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return;
                break;
            default:
                restore_include_path();
        }
    }

    /**
     *
     * @param string $command
     * @param array $output
     * @param int $return_var
     * @return string
     */
    public static function exec(&$command, &$output = null, &$return_var = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return "";
                break;
            default:
                return exec($command, $output, $return_var);
        }
    }

    /**
     *
     * @param string $command
     * @param mixed $return_var
     */
    public static function passthru(&$command, &$return_var = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return;
                break;
            default:
                passthru($command, &$return_var);
        }
    }

    /**
     *
     * @param string $command
     * @param mixed $return_var
     * @return boolean|string
     */
    public static function system(&$command, &$return_var = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return system($command, $return_var);
        }
    }

    /**
     *
     * @param string $command
     * @param string $mode
     * @return boolean|resource
     */
    public static function popen(&$command, &$mode)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return popen($command, $mode);
        }
    }

    /**
     *
     * @param resource $handle
     * @return number
     */
    public static function pclose(&$handle)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return 0;
                break;
            default:
                return pclose($handle);
        }
    }

    /**
     *
     * @return void|mixed
     */
    public static function leak()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return;
                break;
            default:
                return leak();
        }
    }

    /**
     *
     * @param resource $link_identifier
     * @return string|resource
     */
    public static function amysql_list_dbs(&$link_identifier = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return "";
                break;
            default:
                return mysql_list_dbs($link_identifier);
        }
    }

    /**
     *
     * @return void|mixed
     */
    public static function listen()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return;
                break;
            default:
                return listen();
        }
    }

    /**
     *
     * @param string $filename
     * @param mixed $group
     * @return boolean
     */
    public static function chgrp(&$filename, &$group)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return chgrp($filename, $group);
        }
    }

    /**
     *
     * @param string $directory
     * @return boolean|number
     */
    public static function disk_total_space(&$directory)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return disk_total_space($directory);
        }
    }

    /**
     *
     * @param string $directory
     * @return boolean|number
     */
    public static function disk_free_space(&$directory)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return disk_free_space($directory);
        }
    }

    /**
     *
     * @param string $ident
     * @param int $option
     * @param int $facility
     * @return boolean
     */
    public static function openlog(&$ident, &$option, &$facility)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return openlog($ident, $option, $facility);
        }
    }

    /**
     *
     * @return boolean
     */
    public static function closelog()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return closelog();
        }
    }

    /**
     *
     * @param int $priority
     * @param string $message
     * @return boolean
     */
    public static function syslog(&$priority, &$message)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return syslog($priority, $message);
        }
    }

    /**
     *
     * @param resource $handle
     * @param int $operation
     * @param int $wouldblock
     * @return boolean
     */
    public static function flock(&$handle, &$operation, &$wouldblock = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return flock($handle, $operation, $wouldblock);
        }
    }

    /**
     *
     * @param int $port
     * @param int $backlog
     * @return boolean|resource
     */
    public static function socket_create_listen(&$port, &$backlog = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return socket_create_listen($port, $backlog);
        }
    }

    /**
     *
     * @param resource $socket
     * @return boolean|resource
     */
    public static function socket_accept(&$socket)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return socket_accept($socket);
        }
    }

    /**
     *
     * @param resource $socket
     * @param int $backlog
     * @return boolean
     */
    public static function socket_listen(&$socket, &$backlog = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return socket_listen($socket, $backlog);
        }
    }

    /**
     *
     * @param string $target
     * @param string $link
     * @return boolean
     */
    public static function symlink(&$target, &$link)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return symlink($target, $link);
        }
    }

    /**
     *
     * @param Resource $image
     * @param float $angle
     * @param int $bgd_color
     * @param int $ignore_transparent
     * @return boolean|resource
     */
    public static function imagerotate(&$image, &$angle, &$bgd_color, &$ignore_transparent = null)
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return imagerotate($image, $angle, $bgd_color, $ignore_transparent);
        }
    }

    /**
     * fonction template
     * pour la génération de fonction
     *
     * @return boolean|NULL
     * @deprecated
     */
    public static function a()
    {
        switch (self::$MODE) {
            case self::MODE_FREE:
                return false;
                break;
            default:
                return null;
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
        $startWithSeparator = ($path[0] === DIRECTORY_SEPARATOR);
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


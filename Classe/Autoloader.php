<?php
namespace Classe;

class Autoloader
{
    public static function autoload($class)
    {
        $class = str_replace("\\", "/", $class);
        require_once ROOT. "/$class.php";
    }

    public static function register()
    {
        spl_autoload_register([ __CLASS__, "autoload"]);
    }
}
<?php
namespace lambda;

session_start();

/**
 * Class Autoloader
 */
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require 'app/' . $class . '.php';
        }
    }

}

require('config/functions.php');

Autoloader::register();

//Configuration du site
$Site = new Site(
    array(
        'siteName' => 'Lambda',
        'siteLink' => 'http://localhost/lambda/',
        'sqlHost' => 'localhost',
        'sqlName' => 'lambda',
        'sqlUser' => 'mxay',
        'sqlPassword' => 'Pass0104%'
    )
);

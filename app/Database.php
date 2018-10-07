<?php
namespace lambda;
use PDO;
use Exception;

/**
 * Class Database
 * Permet de gérer les requêtes avec la base de donnée
 * @package lambda
 */
class Database extends Site{
    /**
     * @var object Instance PDO
     */
    private static $pdo;

    private static function getPDO(){
        if(self::$pdo === null){
            try{
                $pdo = new PDO('mysql:host='.parent::$sqlHost.';dbname='.parent::$sqlName, parent::$sqlUser, parent::$sqlPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                $pdo->exec("SET NAMES 'UTF8'");
                self::$pdo = $pdo;
            }catch(Exception $e){
                $e->getMessage();
            }
        }
        return self::$pdo;
    }

    /**
     * @param $statement : Requête SQL
     * @param bool $return : Retourne le résultat
     * @param array $data : Données de la requête SQL
     * @param bool $one : Retourne fetch ou fetchall
     * @return array|mixed
     */
    public static function query($statement, $return = false, $data = array(), $one = false){
        try{
            $sql = self::getPDO()->prepare($statement);
            $sql->execute($data);
        }catch(Exception $e){
            $e->getMessage();
        }
        
        if($return){
            if($one){
                return $sql->fetch();
            }else{
                return $sql->fetchAll();
            }
        }
    }
}

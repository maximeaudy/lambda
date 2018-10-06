<?php
namespace lambda;
use PDO;

class Database extends Site{
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

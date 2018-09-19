<?php
class Database{
    private static $pdo;

    private static function getPDO(){
        if(self::$pdo === null){
            $pdo = new PDO('mysql:host=localhost;dbname=cakephp', 'root', 'pass');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $pdo->exec("SET NAMES 'UTF8'");
            self::$pdo = $pdo;
        }
        return self::$pdo;
    }

    public static function query($statement, $data = array(), $return = false, $one = false){
        $sql = self::getPDO()->prepare($statement);
        $sql->execute($data);
        
        if($return){
            if($one){
                return $sql->fetch();
            }else{
                return $sql->fetchAll();
            }
        }
    }
}

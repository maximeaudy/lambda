<?php
require('../../app/Autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $class = $_GET['class'];
    $method = $_GET['method'];
    $data = $_POST;

    if(isset($class) AND isset($method)){

        //Vérification s'il y a une sécurisation d'éditeur de texte
        if(isset($data['editor'])){
            $validation = true;
        }else{
            $validation = false;
        }

        $data = Secure_array($data, $validation);

        $init = new $class(0);
        $init->$method($data);
    }
}else{
    echo "Impossible d'accéder à ce contenu";
}
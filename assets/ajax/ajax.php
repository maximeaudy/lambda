<?php
$class = $_GET['class'];
$method = $_GET['method'];

use lambda\Users;

require('../../app/Autoload.php');

if(isset($class) AND isset($method)){

	//Vérification s'il y a une sécurisation d'éditeur de texte
    if(isset($data['editor'])){
        $validation = true;
    }else{
        $validation = false;
    }

    $data = Secure_array($_POST, $validation);
	$te = new Users(0);
	$te->$method($data);
}
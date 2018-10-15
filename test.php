<?php
require('app/Autoload.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
$class = $_GET['class'];
$method = $_GET['method'];
$data = $_POST;

	if(isset($class) AND isset($method)){

		//Vérification s'il y a une sécurisation d'éditeur de texte
	    if(isset($_SESSION['form'])){
	        $validation = true;
	        //On fusionne le tableau data avec $_SESSION qui contient les champs à sécuriser différement
	        $data = array_merge($_SESSION, $data);
	    }else{
	        $validation = false;
	    }

	    $data = Secure_array($data, $validation);
	    //On détruit aussi tôt les champs à sécuriser différement
        unset($_SESSION['form']);

		$init = new $class(0);
		$init->$method($data);
	}
}else{
	echo "Impossible d'accéder à ce contenu";
}
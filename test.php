<?php
require('app/Autoload.php');
use lambda\Message;

if($_SERVER['REQUEST_METHOD'] == "POST"){
//Nom de la classe à utiliser
$class = $_GET['class'];

//Nom de la méthode de la classe à utiliser
$method = $_GET['method'];

//Données $_POST du formulaire
$data = $_POST;

	if(isset($class) AND isset($method)){

		//Vérification s'il y a une sécurisation d'éditeur de texte
	    if(isset($_SESSION['form#'.$method]['editor'])){
	        $validation = true;
	        //On fusionne le tableau data avec $_SESSION qui contient les champs à sécuriser différement
	        $data = array_merge(array('editor' => $_SESSION['form#'.$method]['editor']), $data);
	    }else{
	        $validation = false;
	    }

	    $data = Secure_array($data, $validation);

        //On retourne seulement les champs requis
        $data_required = array_required_stay($data, $_SESSION['form#'.$method]['required']);
        if(array_not_empty($data_required)) {
            $init = new $class(0);
            $test = $init->$method($data);
        }else return new Message('error', 'Un ou plusieurs champs requis est vide.', $method);
	}

}else{
	echo "Impossible d'accéder à ce contenu";
}
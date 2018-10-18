<?php
require('app/Autoload.php');
use lambda\Message;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Méthode du formulaire
    $method = encrypt_decrypt(2, $_GET['method']);

    //Session du formulaire à utiliser
    $form = $_SESSION['form#'.$method];

    //Données $_POST du formulaire
    $data = $_POST;

	if(isset($form)){

		//Vérification s'il y a une sécurisation d'éditeur de texte
	    if(isset($form['editor'])){
	        $validation = true;
	        //On fusionne le tableau data avec $_SESSION qui contient les champs à sécuriser différement
	        $data = array_merge(array('editor' => $form['editor']), $data);
	    }else{
	        $validation = false;
	    }

	    $data = Secure_array($data, $validation);

        //On retourne seulement les champs requis
        $data_required = array_required_stay($data, $form['required']);
        if(array_not_empty($data_required)) {
            $init = new $form['class']['name'](0);
            $initMethod = $form['class']['method'];
            $test = $init->$initMethod($data);
        }else return new Message('error', 'Un ou plusieurs champs requis est vide.', $method);
	}

}else{
	echo "Impossible d'accéder à ce contenu";
}
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
$class = $_GET['class'];
$method = $_GET['method'];
$data = $_GET['editor'];

require('app/Autoload.php');
	if(isset($class) AND isset($method)){

		//Vérification s'il y a une sécurisation d'éditeur de texte
	    if(!empty($data)){
	        $validation = true;
	        $data = array_merge($_POST, array('editor' => $data));
	    }else{
	        $validation = false;
	        $data = $_POST;
	    }

	    $data = Secure_array($data, $validation);

		$init = new $class(0);
		$init->$method($data);
	}
}else{
	echo "Impossible d'accéder à ce contenu";
}
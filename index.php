<?php 
use lambda\Form;
use lambda\Date;
use lambda\Error;

require('app/Autoload.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?= $SiteName; ?></title>
        <meta name="author" content="">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/mystrap.css">

        <!-- JS -->
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <!-- <?php
        try{
            $pdo = new PDO('mysql:host=dedeed;dbname=dedeed', 'frfrrf', 'frrfrf');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $pdo->exec("SET NAMES 'UTF8'");
        }catch(Exception $e){
            $error = new Error($e);
            $error->getError();
            // echo $e->getCode().'<br>';
            // echo $e->getLine().'<br>';
            // echo $e->getMessage().'<br>';
            // echo $e->getFile().'<br>';
            // echo $e->getPrevious().'<br>';
        }
        ?> -->
        <?php 
            //Méthode sans ajax
            //$login = new Form('lambda\Users', 'login', array_merge($_POST, array('editor' => 'username,password')));
            //Méthode avec ajax
            $login = new Form('lambda\Users', 'login', array(), true); 
        ?>
        <p>Connaitre l'ID de la personne via son nom d'utilisateur</p>
        <?php  
            $login->form(array('method' => 'post', 'id' => 'login'));

            $login->input(
                array(
                'label' => 'Nom d\'utilisateur',
                'name' => 'username',
                'type' => 'text'
                )
            );

            $login->input(
                array(
                    'type' => 'submit',
                    'name' => 'login',
                    'value' => 'Valider'
                )
            );

            $login->endform();
        ?>
        <!-- VOIR COMMENT RECUPERER LES VALEURS VIA AJAX METHODE LA PLUS SIMPLE -->
        <?php 
            //Date
            $date_now = '1538665976';
            echo $date_now.'<br>';

            Date::before($date_now).'<br>';
        ?>
    </body>
</html>

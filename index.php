<?php 
use lambda\Form;
use lambda\Date;

require('app/Autoload.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?= $Site->siteName; ?></title>
        <meta name="author" content="">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/alert.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/mystrap.css">

        <!-- JS -->
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="assets/js/alert.js"></script>
        <script type="text/javascript" src="assets/js/Message.js"></script>
    </head>
    <body>
        <?php
            //Méthode avec ajax
            $login = new Form('lambda\Users', 'login', '', 11);
        ?>
        <p>Espace membre</p>
        <?php
            $login->form(array('method' => 'post'));

            $login->input(
                array(
                'label' => 'Nom d\'utilisateur',
                'name' => 'username',
                'required' => true,
                'type' => 'text'
                )
            );

            $login->input(
                array(
                    'label' => 'Mot de passe',
                    'name' => 'pass',
                    'required' => true,
                    'type' => 'password'
                )
            );

            $login->input(
                array(
                    'type' => 'submit',
                    'value' => 'Se connecter'
                )
            );

            $login->endform();
        ?>
    </body>
</html>

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
        <link rel="stylesheet" href="assets/css/alert.css?<?= time(); ?>">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/mystrap.css">

        <!-- JS -->
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="assets/js/alert.js?<?= time(); ?>"></script>
        <script type="text/javascript" src="assets/js/Message.js?<?= time(); ?>"></script>
    </head>
    <body>
        <?php
            //Méthode avec ajax
            $login = new Form('lambda\Users', 'login', $_POST, false);
        ?>
        <p>Entrez le prénom de l'utilisateur</p>
        <div id="messageDiv"></div>
        <?php  
            $login->form(array('method' => 'post'));

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
                    'value' => 'Valider'
                )
            );

            $login->endform();
        ?>
        <?php
            //Date
            $date_now = '1538665976';
            echo $date_now.'<br>';

            echo Date::before($date_now).'<br>';
        ?>
    </body>
</html>

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
        <script type="text/javascript" src="assets/js/Message.js"></script>
    </head>
    <body>
        <?php
            //Méthode sans ajax
            //$login = new Form('lambda\Users', 'login', array_merge($_POST, array('editor' => 'username,password')));
            //Méthode avec ajax
            $login = new Form('lambda\Users', 'login', array(), true); 
        ?>
        <p>Connaitre l'ID de la personne via son nom d'utilisateur</p>
        <div id="messageDiv"></div>
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
                    'value' => 'Valider',
                    'id' => 'showGo'
                )
            );

            $login->endform('messageAlert');
        ?>
        <script>
            var arr = [ "one", "two", "three", "four", "five" ];
            var obj = { one: 1, two: 2, three: 3, four: 4, five: 5 };

            jQuery.each( arr, function( i, val ) {
                $( "#" + val ).text( "Mine is " + val + "." );

                // Will stop running after "three"
                return ( val !== "three" );
            });

            jQuery.each( obj, function( i, val ) {
                $( "#" + i ).append( document.createTextNode( " - " + val ) );
            });
        </script>
        <div id="alert-area" class="alert-area"></div>
        <?php
            //Date
            $date_now = '1538665976';
            echo $date_now.'<br>';

            echo Date::before($date_now).'<br>';
        ?>
        <script type="text/javascript" src="assets/js/alert.js"></script>
        <script>
            var alertbox = new AlertBox({
                closeTime: 5000,
                persistent: false,
                hideCloseButton: true
            });
            //$("#showGo").on('click', function () {
            //    alertbox.show('Hello! This is a message.');
            //});
        </script>
    </body>
</html>

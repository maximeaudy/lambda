<?php require('app/Autoload.php'); ?>
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
    </head>
    <body>
        <?php 
            // $Auj = new Date();

            // echo $Auj->number(5848494, '/');

            // echo $Auj->full(1114448444);
            echo 'Il y a ';
            echo Date::before(1536759000);
        ?>
    </body>
</html>

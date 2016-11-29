<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/Users/ClassUsers.php';

if (isset($_POST['nom'])) {
    $Id = ClassUsers::NewIdByName($_POST['nom']);
    $_SESSION['UserId'] = $Id;
    echo "Id = " . $Id;
}

if (isset($_GET['nom'])) {
    $Id = $_GET['nom'];
    $_SESSION['UserId'] = $Id;
    echo "nom : " . $_GET['nom'] . " ; Id = " . $Id;
    $_SESSION['sousMenu']="User";
}


$_SESSION['affichageCorps'] = 'affUser';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);



$_SESSION['sousMenu'] = 'Options';
$_SESSION['affichageCorps'] = "Options";


if (isset($_POST['OptionStatusSim'])) {
    $_SESSION['OptionStatusSim'] = $_POST['OptionStatusSim'];
}

if (isset($_POST['OptionStatusTel'])) {
    $_SESSION['OptionStatusTel'] = $_POST['OptionStatusTel'];
}

if (isset($_POST['OptionSelectUser'])) {
    $_SESSION['OptionSelectUser'] = $_POST['OptionSelectUser'];
}


echo "on sort de selectOptions.php";

header("location: /SIM");

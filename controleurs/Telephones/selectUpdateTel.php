<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/Phones/ClassPhone.php';


if (isset($_GET['IMEI'])){
    //echo "<p> on recupere l'IMEI : " . $_GET['IMEI'] . "</p>";
    $tmp=  ClassPhone::NewByIMEI($_GET['IMEI']);
    //echo "<p> objet recupere avec NewByIMEI : " . print_r($tmp) . "</p>";
    //print_r($tmp);
    $_SESSION['CreateTel']=serialize($tmp);
}else{
    $tmp=null;
    unset($_SESSION['CreateTel']);
}


echo"<br>";
$_SESSION['affichageCorps'] = 'UpdateTel';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/USIM/ClassSIM.php';


if (isset($_GET['ICCID'])){
    $tmp=  ClassSIM::NewByICCID($_GET['ICCID']);
    $_SESSION['CreateUsim']=serialize($tmp);
}else{
    $tmp=null;
    unset($_SESSION['CreateUsim']);
}


echo"<br>";
$_SESSION['affichageCorps'] = 'updateUsim';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


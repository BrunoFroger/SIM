<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);



$_SESSION['sousMenu']='Usim';
$_SESSION['affichageCorps']="";

unset($_SESSION['ICCID']);
unset($_SESSION['MSIDN']);

echo "on sort de selectUsers.php";

header("location: /SIM");

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM/';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

unset($_SESSION['sousMenu']);
unset($_SESSION['UserId']);
unset($_SESSION['affichageCorps']);
unset($_SESSION['MSISDN']);
unset($_SESSION['ICCID']);


header("location: /SIM");

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);


echo"<br>";
$_SESSION['affichageCorps'] = 'createUsim';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


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
include_once 'modeles/USIM/ClassSIM.php';
include_once 'modeles/Phones/ClassPhone.php';

echo "<div id='entete'>";
include_once 'controleurs/acceuil/entete.php';
echo "</div>";

echo "<div id='menu'>";
include_once 'controleurs/acceuil/menu.php';
echo "</div>";

echo "<div id='corps'>";
include 'controleurs/acceuil/corps.php';
echo "</div>";

echo "<div id='pied'>";
include_once 'controleurs/acceuil/pied.php';
echo "</div>";


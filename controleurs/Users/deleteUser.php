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



if (isset($_GET['ID'])) {
    echo "<br> suppression d'un user ".$_GET['ID'];
    //$result = ClassUsers::delete($_GET['ID']);
    $result = null;
    if ($result == null){
        echo "<br> erreur lors de la suppression du telephone";
    }else{
        echo "<br> Suppression OK";
    }
}


echo "<br>on sort de deleteUser.php";

echo "<br><a href=/SIM/index.php>Continuer</a>";
//header("location: /SIM");

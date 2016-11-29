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



if (isset($_GET['ICCID'])) {
    echo "<br> suppression de la SIM ".$_GET['ICCID'];
    $result = ClassSIM::delete($_GET['ICCID']);
    if ($result == null){
        echo "<br> erreur lors de la suppression de la SIM";
    }else{
        echo "<br> Suppression OK";
    }
}


echo "<br>on sort de deleteSIM.php";

//echo "<br><a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");
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
include_once 'modeles/Users/ClassUsers.php';

if (isset($_POST['ICCID']) || isset($_POST['MSISDN']) || isset($_POST['User'])) {
    if (isset($_POST['ICCID'])) {
        if ($_POST['ICCID'] != "") {
            $Iccid = $_POST['ICCID'];
            $_SESSION['ICCID'] = $Iccid;
            //echo "<br> on positionne le ICCID";
        } else {
            $Iccid = "";
            unset($_SESSION['ICCID']);
        }
    }

    if (isset($_POST['MSISDN'])) {
        if ($_POST['MSISDN'] != "") {
            $Msisdn = $_POST['MSISDN'];
            $_SESSION['MSISDN'] = $Msisdn;
            //echo "<br> on positionne le MSISDN";
        } else {
            $Msisdn = "";
            unset($_SESSION['MSISDN']);
        }
    }

    if (isset($_POST['User'])) {
        if ($_POST['User'] != "") {
            $User = $_POST['User'];
            $_SESSION['SIMUser'] = ClassUsers::NewIdByName($User);
            //echo "<br> on positionne le User";
        } else {
            $User = "";
            unset($_SESSION['SIMUser']);
        }
    }

    echo "<br>Iccid = " . $Iccid;
    echo "<br>Msisdn = " . $Msisdn;
    echo "<br>User = " . $User;
}


if (isset($_GET['ICCID']) || isset($_GET['MSISDN']) || isset($_GET['User'])) {
    if (isset($_GET['ICCID'])) {
        if ($_GET['ICCID'] != "") {
            $Iccid = $_GET['ICCID'];
            $_SESSION['ICCID'] = $Iccid;
            //echo "<br> on positionne le ICCID";
        } else {
            $Iccid = "";
            unset($_SESSION['ICCID']);
        }
    }
    if (isset($_GET['MSISDN'])) {
        if ($_GET['MSISDN'] != "") {
            $Msisdn = $_GET['MSISDN'];
            $_SESSION['MSISDN'] = $Msisdn;
            //echo "<br> on positionne le MSISDN";
        } else {
            $Msisdn = "";
            unset($_SESSION['MSISDN']);
        }
    }
    if (isset($_GET['User'])) {
        if ($_GET['User'] != "") {
            $User = $_GET['User'];
            $_SESSION['SIMUser'] = ClassUsers::NewIdByName($User);
            //echo "<br> on positionne le User";
        } else {
            $User = "";
            unset($_SESSION['SIMUser']);
        }
    }

    echo "<br>Iccid = " . $Iccid;
    echo "<br>Msisdn = " . $Msisdn;
    echo "<br>User = " . $User;
    $_SESSION['sousMenu'] = "";
}

echo"<br>";
$_SESSION['affichageCorps'] = 'affUsim';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


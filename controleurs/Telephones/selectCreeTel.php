Te<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/Phones/ClassPhone.php';

if (isset($_POST['TelId']) || isset($_POST['IMEI']) || isset($_POST['User']) || isset($_POST['TelUser'])) {

    if (isset($_POST['IMEI'])) {
        if ($_POST['IMEI'] != "") {
            $IMEI = $_POST['IMEI'];
            $_SESSION['IMEI'] = $IMEI;
            //echo "<br> on positionne le MSISDN";
        } else {
            $IMEI = "";
            unset($_SESSION['IMEI']);
        }
    }

    if (isset($_POST['marque'])) {
        if ($_POST['marque'] != "") {
            $marque = $_POST['marque'];
            $_SESSION['marque'] = $marque;
            //echo "<br> on positionne le User";
        } else {
            $User = "";
            unset($_SESSION['marque']);
        }
    }

    if (isset($_POST['model'])) {
        if ($_POST['model'] != "") {
            $model = $_POST['model'];
            $_SESSION['model'] = $model;
            //echo "<br> on positionne le User";
        } else {
            $User = "";
            unset($_SESSION['model']);
        }
    }

    if (isset($_POST['TelUser'])) {
        if ($_POST['TelUser'] != "") {
            $TelUser = $_POST['TelUser'];
            $_SESSION['TelUser'] = $TelUser;
            //echo "<br> on positionne le User";
        } else {
            $User = "";
            unset($_SESSION['$TelUser']);
        }
    }

    echo "<br> POST";
    echo "<br>IMEI = " . $TelId;
    echo "<br>marque = " . $marque;
    echo "<br>model = " . $model;
}


if (isset($_GET['TelId']) || isset($_GET['IMEI']) || isset($_GET['User'])) {

    if (isset($_GET['TelId'])) {
        if ($_GET['TelId'] != "") {
            $TelId = $_GET['TelId'];
            $_SESSION['TelId'] = $Iccid;
            //echo "<br> on positionne le ICCID";
        } else {
            $TelId = "";
            unset($_SESSION['TelId']);
        }
    }

    if (isset($_GET['IMEI'])) {
        if ($_GET['IMEI'] != "") {
            $IMEI = $_GET['IMEI'];
            $_SESSION['IMEI'] = $IMEI;
            //echo "<br> on positionne le MSISDN";
        } else {
            $IMEI = "";
            unset($_SESSION['IMEI']);
        }
    }

    if (isset($_GET['User'])) {
        if ($_GET['User'] != "") {
            $User = $_GET['User'];
            $_SESSION['TelUser'] = ClassUsers::NewIdByName($User);
            //echo "<br> on positionne le User";
        } else {
            $User = "";
            unset($_SESSION['TelUser']);
        }
    }

    echo "<br> POST";
    echo "<br>TelId = " . $TelId;
    echo "<br>IMEI = " . $IMEI;
    echo "<br>IdTel = " . $IdTel;
    $_SESSION['sousMenu'] = "";
}

echo"<br>";
$_SESSION['affichageCorps'] = 'creeTel';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


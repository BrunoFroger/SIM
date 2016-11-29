Te<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/Phone/ClassPretPhone.php';
include_once 'modeles/Phone/ClassPhone.php';

if (isset($_POST['IMEI']) || isset($_POST['marque']) || isset($_POST['model']) || isset($_POST['TelUser'])) {

    if (isset($_POST['IMEI'])) {
        if ($_POST['IMEI'] != "") {
            $IMEI = $_POST['IMEI'];
            $_SESSION['IMEI'] = $IMEI;
        } else {
            $IMEI = "";
            unset($_SESSION['IMEI']);
        }
    }

    if (isset($_POST['marque'])) {
        if ($_POST['marque'] != "") {
            $marque = $_POST['marque'];
            $_SESSION['marque'] = $marque;
        } else {
            $marque = "";
            unset($_SESSION['marque']);
        }
    }

    if (isset($_POST['model'])) {
        if ($_POST['model'] != "") {
            $model = $_POST['model'];
            $_SESSION['model'] = $model;
        } else {
            $model = "";
            unset($_SESSION['model']);
        }
    }

    if (isset($_POST['TelUser'])) {
        if ($_POST['TelUser'] != "") {
            $TelUser = $_POST['TelUser'];
            $_SESSION['TelUser'] = ClassUsers::NewIdByName($TelUser);
        } else {
            $TelUser = "";
            unset($_SESSION['TelUser']);
        }
    }

    echo "<br> POST";
    echo "<br>IMEI = " . $IMEI;
    echo "<br>marque = " . $marque;
    echo "<br>model = " . $model;
    echo "<br>TelUser = " . $TelUser;
}


if (isset($_GET['IMEI']) || isset($_GET['marque']) || isset($_GET['model']) || isset($_GET['TelUser'])) {

    if (isset($_GET['IMEI'])) {
        if ($_GET['IMEI'] != "") {
            $IMEI = $_GET['IMEI'];
            $_SESSION['IMEI'] = $IMEI;
        } else {
            $IMEI = "";
            unset($_SESSION['IMEI']);
        }
    }

    if (isset($_GET['marque'])) {
        if ($_GET['marque'] != "") {
            $marque = $_GET['marque'];
            $_SESSION['marque'] = $marque;
        } else {
            $marque = "";
            unset($_SESSION['marque']);
        }
    }

    if (isset($_GET['model'])) {
        if ($_GET['model'] != "") {
            $model = $_GET['model'];
            $_SESSION['model'] = $model;
        } else {
            $model = "";
            unset($_SESSION['model']);
        }
    }

    if (isset($_GET['TelUser'])) {
        if ($_GET['TelUser'] != "") {
            $TelUser = $_GET['TelUser'];
            $_SESSION['TelUser'] = ClassUsers::NewIdByName($TelUser);
        } else {
            $TelUser = "";
            unset($_SESSION['TelUser']);
        }
    }

    echo "<br> GET";
    echo "<br>IMEI = " . $IMEI;
    echo "<br>marque = " . $marque;
    echo "<br>model = " . $model;
    echo "<br>TelUser = " . $TelUser;
    $_SESSION['sousMenu'] = "";
}

echo"<br>";
$_SESSION['affichageCorps'] = 'affTel';

//echo "<a href=/SIM/index.php>Continuer</a>";
header("location: /SIM");


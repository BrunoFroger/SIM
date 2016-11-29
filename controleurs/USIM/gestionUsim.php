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

if (isset($_SESSION['FormUsim'])) {
    $Bouton = $_SESSION['FormUsim'];
} else {
    $Bouton = "??";
}

echo "<br> action = ".$Bouton;

if (isset($_SESSION['CreateUsim'])) {
    $usim = unserialize($_SESSION['CreateUsim']);
} else {
    $usim = new ClassSIM();
}

echo "<br> on travaille sur la SIM :";
print_r($usim);

$set = 0;

if (isset($_POST['ICCID'])) {
    $usim->ICCID = $_POST['ICCID'];
    echo "<br>ICCID = " . $usim->ICCID;
    $set = 1;
}

if (isset($_POST['User'])) {
    $usim->User = $_POST['User'];
    echo "<br>User = " . $usim->User;
    $set = 1;
}

if (isset($_POST['MSISDN'])) {
    $usim->MSISDN = $_POST['MSISDN'];
    echo "<br>MSISDN = " . $usim->MSISDN;
    $set = 1;
}

if (isset($_POST['DR'])) {
    $usim->DR = $_POST['DR'];
    echo "<br>DR = " . $usim->DR;
    $set = 1;
}

if (isset($_POST['ExpDate'])) {
    $usim->ExpDate = $_POST['ExpDate'];
    echo "<br>ExpDate = " . $usim->ExpDate;
    $set = 1;
}

if (isset($_POST['PIN'])) {
    $usim->PIN = $_POST['PIN'];
    echo "<br>PIN = " . $usim->PIN;
    $set = 1;
}

if (isset($_POST['PUK'])) {
    $usim->PUK = $_POST['PUK'];
    echo "<br>PUK = " . $usim->PUK;
    $set = 1;
}

if ($set = 1) {
    $_SESSION['CreateUsim'] = serialize($usim);
    echo "<br> on test si la SIM existe : ";
    print_r($usim);
    $tmp = ClassSIM::Exist($usim);
    echo "<br> valeur de retour du test : ";
    print_r($tmp);
    if ($tmp == NULL) {
        if ($Bouton == 'creation') {
            echo "<br> on cree la SIM en base";
            $usim->createBase();
            echo "<a href=/SIM/index.php>Continuer</a>";
            $_SESSION['affichageCorps'] = 'updateUsim';
            header("location: /SIM");
        } elseif ($Bouton == 'MAJ') {
            echo "<br> on met a jour la SIM [$tmp] en base";
            $usim->ICCID = $tmp;
            $usim->updateBase();
            echo "<a href=/SIM/index.php>Continuer</a>";
            header("location: /SIM");
        }
    } elseif ($Bouton == 'MAJ') {
        echo "<br> on met a jour la SIM [$tmp] en base";
        $usim->ICCID = $tmp;
        $usim->updateBase();
        echo "<a href=/SIM/index.php>Continuer</a>";
        header("location: /SIM");
    } else {
        echo "<br> cette SIM existe deja";
        $_SESSION['affichageCorps'] = 'updateUsim';
        echo "<a href=/SIM/index.php>Continuer</a>";
    }
}else{
    echo "<br> aucune valeurs modifiees ; on ne fait rien";
}

echo "<a href=/SIM/index.php>Continuer</a>";

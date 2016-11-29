<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
$myIncludePath = '/var/www/SIM';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);


include_once 'modeles/Phones/ClassPhone.php';

if (isset($_SESSION['FormTel'])) {
    $Bouton = $_SESSION['FormTel'];
} else {
    $Bouton = "??";
}

echo "<br> action = ".$Bouton;

if (isset($_SESSION['CreateTel'])) {
    $phone = unserialize($_SESSION['CreateTel']);
} else {
    $phone = new ClassPhone();
}

echo "<br> on travaille sur le Telephone :";
print_r($phone);

$set = 0;

if (isset($_POST['Id'])) {
    $phone->Id = $_POST['Id'];
    echo "<br>Id = " . $phone->Id;
    $set = 1;
}

if (isset($_POST['IMEI'])) {
    $phone->IMEI = $_POST['IMEI'];
    echo "<br>IMEI = " . $phone->IMEI;
    $set = 1;
}

if (isset($_POST['marque'])) {
    $phone->marque = $_POST['marque'];
    echo "<br>marque = " . $phone->marque;
    $set = 1;
}

if (isset($_POST['model'])) {
    $phone->model = $_POST['model'];
    echo "<br>model = " . $phone->model;
    $set = 1;
}

if (isset($_POST['TelUser'])) {
    $phone->TelUser = $_POST['TelUser'];
    echo "<br>TelUser = " . $phone->TelUser;
    $set = 1;
}

if (isset($_POST['Commentaire'])) {
    $phone->Commentaire = $_POST['Commentaire'];
    echo "<br>Commentaire = " . $phone->Commentaire;
    $set = 1;
}

if ($set = 1) {
    $_SESSION['CreateTel'] = serialize($phone);
    echo "<br> on test si le Telephone existe : ";
    print_r($phone);
    $tmp = ClassPhone::Exist($phone);
    echo "<br> valeur de retour du test : ";
    print_r($tmp);
    if ($tmp == NULL) {
        if ($Bouton == 'creation') {
            $phone->Id='';
            echo "<br> on cree le telephone en base";
            print_r($phone);
            $phone->createBase();
            $_SESSION['affichageCorps'] = 'updateTel';
            echo "<br><a href=/SIM/index.php>Continuer</a>"; 
            //return;
            header("location: /SIM");
        } elseif ($Bouton == 'MAJ') {
            echo "<br> on met a jour le Telephone [$tmp] en base";
            $phone->updateBase();
            echo "<br><a href=/SIM/index.php>Continuer</a>"; 
            //return;
            header("location: /SIM");
        }
    } elseif ($Bouton == 'MAJ') {
        echo "<br> on met a jour le Telephone[$tmp] en base";
        $phone->updateBase();
        echo "<a href=/SIM/index.php>Continuer</a>";
        //return;
        header("location: /SIM");
    } else {
        echo "<br> ce Telephone existe deja";
        $_SESSION['affichageCorps'] = 'updateTel';
        echo "<br><a href=/SIM/index.php>Continuer</a>"; 
        return;
    }
}else{
    echo "<br> aucune valeurs modifiees ; on ne fait rien";
}

echo "<br><a href=/SIM/index.php>Continuer</a>";

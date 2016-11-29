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

if (isset($_SESSION['FormUser'])) {
    $Bouton = $_SESSION['FormUser'];
} else {
    $Bouton = "??";
}


if (isset($_SESSION['CreateUser'])) {
    $user = unserialize($_SESSION['CreateUser']);
} else {
    $user = new ClassUsers();
}

$set = 0;

if (isset($_POST['Nom'])) {
    $user->Nom = $_POST['Nom'];
    echo "<br>Nom = " . $user->Nom;
    $set = 1;
}

if (isset($_POST['Prenom'])) {
    $user->Prenom = $_POST['Prenom'];
    echo "<br>Prenom = " . $user->Prenom;
    $set = 1;
}

if (isset($_POST['Societe'])) {
    $user->Societe = $_POST['Societe'];
    echo "<br>Societe = " . $user->Societe;
    $set = 1;
}

if (isset($_POST['Service'])) {
    $user->Service = $_POST['Service'];
    echo "<br>Service = " . $user->Service;
    $set = 1;
}
if (isset($_POST['Email'])) {
    $user->Email = $_POST['Email'];
    echo "<br>Email = " . $user->Email;
    $set = 1;
}

if ($set = 1) {
    $_SESSION['CreateUser'] = serialize($user);
    $tmp = ClassUsers::Exist($user);
    print_r($user);
    if ($tmp == NULL) {
        if ($Bouton == 'creation') {
            echo "<br> on cree le user en base";
            $user->createBase();
            echo "<a href=/SIM/index.php>Continuer</a>";
            $_SESSION['affichageCorps'] = 'updateUser';
            header("location: /SIM");
        } elseif ($Bouton == 'MAJ') {
            echo "<br> on met a jour le user [$tmp] en base";
            $user->Id=$tmp;
            $user->updateBase();
            echo "<a href=/SIM/index.php>Continuer</a>";
            header("location: /SIM");
        }
    } elseif ($Bouton == 'MAJ') {
        echo "<br> on met a jour le user [$tmp] en base";
            $user->Id=$tmp;
        $user->updateBase();
        echo "<a href=/SIM/index.php>Continuer</a>";
        header("location: /SIM");
    } else {
        echo "<br> ce user existe deja";
        $_SESSION['affichageCorps'] = 'updateUser';
        echo "<a href=/SIM/index.php>Continuer</a>";
    }
}


    
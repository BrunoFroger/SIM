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
include_once 'modeles/Phones/ClassPhone.php';
include_once 'modeles/Users/ClassUsers.php';

echo "<br> traitement des cartes SIM";
$fic = "/tmp/SIM/SIM.csv";
//$fic = "SIM.csv";
$sep = ";";
$fichierCsv = fopen($fic, "w+");
if ($fichierCsv != null) {

    $ListeSim = ClassSIM::getList();
//print_r($ListeSim);

    foreach ($ListeSim as $item) {
        $sim = ClassSIM::NewByICCID($item['ICCID']);
        //print_r($sim);

        $ligne = array("$sim->ICCID", "$sim->User", "$sim->MSISDN",
            "$sim->DR", $sim->CreationDate, "$sim->ExpDate", "$sim->PIN", "$sim->PUK");

        echo "<br>";
        print_r($ligne);
        fputcsv($fichierCsv, $ligne, $sep);
    }
} else {
    echo "<br> erreur ouverture du fichier $fic";
}
fclose($fichierCsv);

echo "<br> traitement des telephones";
$fic = "/tmp/SIM/Phones.csv";
$sep = ";";
$fichierCsv = fopen($fic, "w+");
if ($fichierCsv != null) {

    $ListeTel = ClassPhone::getList();
//print_r($ListeTel);

    foreach ($ListeTel as $item) {
        $tel = ClassPhone::NewgetById($item['Id']);
        //print_r($tel);

        $ligne = array("$tel->Id", "$tel->IMEI", 
            "$tel->marque", "$tel->model", "$tel->TelUser");

        echo "<br>";
        print_r($ligne);
        fputcsv($fichierCsv, $ligne, $sep);
    }
} else {
    echo "<br> erreur ouverture du fichier $fic";
}
fclose($fichierCsv);


echo "<br> traitement des Users";
$fic = "/tmp/SIM/Users.csv";
$sep = ";";
$fichierCsv = fopen($fic, "w+");
if ($fichierCsv != null) {

    $ListeUsers = ClassUsers::getList();
//print_r($ListeUsers);

    foreach ($ListeUsers as $item) {
        $user = ClassUsers::NewById($item['Id']);
        //print_r($tel);

        $ligne = array("$user->Id", "$user->Nom", "$user->Prenom", 
            "$user->Societe", "$user->Service", "$user->Email");

        echo "<br>";
        print_r($ligne);
        fputcsv($fichierCsv, $ligne, $sep);
    }
} else {
    echo "<br> erreur ouverture du fichier $fic";
}
fclose($fichierCsv);


echo "<br>on sort de export CSV.php";


echo "<br><a href=/SIM/index.php>Continuer</a>";
//header("location: /SIM");
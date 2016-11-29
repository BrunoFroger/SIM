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

$fic = "/tmp/SIM/SIM.csv";
//$fic = "SIM.csv";
$sep = ";";
$fichierCsv = fopen($fic, "a+");

echo "<br> liste des SIM inserees<br><br>";
echo "<table>";
echo "<tr>";
echo "   <th>ICCID</th>";
echo "   <th>User</th>";
echo "   <th>MSISDN</th>";
echo "   <th>DR</th>";
echo "   <th>ExpDate</th>";
echo "   <th>PIN</th>";
echo "   <th>PUK</th>";
echo "</tr>";
if ($fichierCsv != null) {
    while ($ligne = fgetcsv($fichierCsv, 512, $sep)) {

        $nbChamps = count($ligne);
        //print_r($ligne);
        $tmp = new ClassSIM();
        $tmp->ICCID = $ligne['0'];
        //echo "<br>$tmp->ICCID";
        $tmp->User = $ligne['1'];
        //echo "<br>$tmp->User";
        $tmp->MSISDN = $ligne['2'];
        //echo "<br>$tmp->MSISDN";
        $tmp->DR = $ligne['3'];
        //echo "<br>$tmp->DR";
        $tmp->ExpDate = $ligne['4'];
        //echo "<br>$tmp->ExpDate";
        $tmp->PIN = $ligne['5'];
        //echo "<br>$tmp->PIN";
        $tmp->PUK = $ligne['6'];
        //echo "<br>$tmp->PUK";
        if (!ClassSIM::Exist($tmp)) {
            echo "<tr>";
            echo "   <td>$tmp->ICCID</td>";
            echo "   <td>$tmp->User</td>";
            echo "   <td>$tmp->MSISDN</td>";
            echo "   <td>$tmp->ExpDate</td>";
            echo "   <td>$tmp->PIN</td>";
            echo "   <td>$tmp->PUK</td>";
            echo "</tr>";
            $tmp->createBase();
        }
    }
} else {
    echo "<br> erreur ouverture du fichier $fic";
}
echo "</table>";

$fic = "/tmp/SIM/Phones.csv";
$sep = ";";
$fichierCsv = fopen($fic, "a+");

echo "<br> liste des Telephones inseres<br><br>";
echo "<table>";
echo "<tr>";
echo "   <th>Id</th>";
echo "   <th>IMEI</th>";
echo "   <th>marque</th>";
echo "   <th>model</th>";
echo "   <th>TelUser</th>";
echo "</tr>";
if ($fichierCsv != null) {
    while ($ligne = fgetcsv($fichierCsv, 512, $sep)) {

        $nbChamps = count($ligne);
        //print_r($ligne);
        $tmp = new ClassPhone();
        $tmp->Id = $ligne['0'];
        //echo "<br>$tmp->ICCID";
        $tmp->IMEI = $ligne['1'];
        //echo "<br>$tmp->User";
        $tmp->marque = $ligne['2'];
        //echo "<br>$tmp->MSISDN";
        $tmp->model = $ligne['3'];
        //echo "<br>$tmp->DR";
        $tmp->TelUser = $ligne['4'];
        if (!ClassPhone::Exist($tmp)) {
            echo "<tr>";
            echo "   <td>$tmp->Id</td>";
            echo "   <td>$tmp->IMEI</td>";
            echo "   <td>$tmp->marque</td>";
            echo "   <td>$tmp->model</td>";
            echo "   <td>$tmp->TelUser</td>";
            echo "</tr>";
            $tmp->createBase();
        }
    }
} else {
    echo "<br> erreur ouverture du fichier $fic";
}
echo "</table>";


$fic = "/tmp/SIM/Users.csv";
$sep = ";";
$fichierCsv = fopen($fic, "a+");

echo "<br> liste des Users inseres<br><br>";
echo "<table>";
echo "<tr>";
echo "   <th>Id</th>";
echo "   <th>Nom</th>";
echo "   <th>Prenom</th>";
echo "   <th>Societe</th>";
echo "   <th>Service</th>";
echo "   <th>Email</th>";
echo "</tr>";
if ($fichierCsv != null) {
    while ($ligne = fgetcsv($fichierCsv, 512, $sep)) {

        $nbChamps = count($ligne);
        //print_r($ligne);
        $tmp = new ClassUsers();
        $tmp->Id = $ligne['0'];
        //echo "<br>$tmp->ICCID";
        $tmp->Nom = $ligne['1'];
        //echo "<br>$tmp->User";
        $tmp->Prenom = $ligne['2'];
        //echo "<br>$tmp->MSISDN";
        $tmp->Societe = $ligne['3'];
        //echo "<br>$tmp->DR";
        $tmp->Service = $ligne['4'];
        $tmp->Email = $ligne['5'];
        if (!ClassUsers::Exist($tmp)) {
            echo "<tr>";
            echo "   <td>$tmp->Id</td>";
            echo "   <td>$tmp->Nom</td>";
            echo "   <td>$tmp->Prenom</td>";
            echo "   <td>$tmp->Societe</td>";
            echo "   <td>$tmp->Service</td>";
            echo "   <td>$tmp->Email</td>";
            echo "</tr>";
            $tmp->createBase();
        }
    }
} else {
    echo "<br> erreur ouverture du fichier $fic";
}
echo "</table>";



//echo "<br>on sort de export CSV.php";


echo "<br><a href=/SIM/index.php>Continuer</a>";
//header("location: /SIM");

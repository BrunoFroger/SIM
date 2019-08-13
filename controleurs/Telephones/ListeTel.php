<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cptTelAffichees = 0;
$dateCourante=date('Y-m-d');

//echo "<br> Date Courante = $dateCourante";
               
if (isset($_SESSION['OptionStatusTel'])) {
    $OptionStatusTel = $_SESSION['OptionStatusTel'];
} else {
    $OptionStatusTel = "";
}
 
if (isset($_SESSION['OptionSelectUser'])) {
    $OptionSelectUser = $_SESSION['OptionSelectUser'];
} else {
    $OptionSelectUser = 0;
}

$listeUsers = ClassUsers::getList();


echo "<br> <br> OPTIONS d'affichage";
echo "<table border=1px>";
echo "  <tr>";
echo "      <th>nom de l'option</th>";
echo "      <th>Valeur</th>";
echo "  </tr>";
echo "  <tr>";
echo "      <td>status du telephone</td>";
echo "      <td>$OptionStatusTel</td>";
echo "  </tr>";
echo "  <tr>";
echo "      <td>filtrage sur User</td>";
if ($OptionSelectUser != 0) {
    //$tmp=
    echo "  <td>" . ClassUsers::NewById($OptionSelectUser)->Nom . "</td>";
}else{
    echo "  <td>Tous</td>";
}
echo "  </tr>";
echo "</table>";

echo "<br> <br> Liste des telephones en base";
echo " (" . ClassPhone::NbFreeTel() . " telephones disponibles)";
echo "<br><br>";
// on affiche la liste des sim
echo "<table border=1px>";
echo "  <tr>";
echo "      <th>IMEI</th>";
echo "      <th>marque</th>";
echo "      <th>modele</th>";
echo "      <th>Utilisateur</th>";
echo "      <th>Commentaire</th>";
echo "      <th>Suppression</th>";
echo "  </tr>";

$liste = ClassPhone::getList();
//print_r($liste);
//echo "<p>filtre status telephone : " . $OptionStatusTel . "</p>";

foreach ($liste as $item) {
    $tmp = ClassPhone::NewById($item['Id']);
    //echo "<p>traitement de l'item : " . $item['Id'];
    //echo "<br>telephone (tmp) : ". print_r($tmp) . "<p>";
    $user = ClassUsers::NewById($tmp->TelUser);
    //echo "<p>User = " . print_r($user) . "</p>";
    switch ($OptionStatusTel) {// filtrage sur status des Telephones
        case 'Tous' :
            $affiche = 1;
            break;
        case 'Libre' :
            if ($tmp->TelUser <> 0) {
                $affiche = 0;
            } else {
                $affiche = 1;
            }
            break;
        case 'Affecte' :
            if ($tmp->TelUser == 0) {
                $affiche = 0;
            } else {
                $affiche = 1;
            }
            break;
        default :
            $affiche = 1;
            break;
    }

    if ($user <> null) {// filtrage sur user
        if ($OptionSelectUser != 0 && $affiche == 1) {
            if ($user->Id != $OptionSelectUser) {
                $affiche = 0;
            }
        }
    }else{
        if ($OptionSelectUser != 0 && $affiche == 1) {
            $affiche = 0;
        }
    }


    if ($affiche == 1) {
        $cptTelAffichees += 1;
        if ($user <> null) {
            $affUser = "$user->Nom $user->Prenom";
        } else {
            $affUser = "Non affectee";
        }

        echo "  <tr>";
        echo "      <td><a href='controleurs/Telephones/selectUpdateTel.php?IMEI=" . $tmp->IMEI . "'>$tmp->IMEI</a></td>";
        echo "      <td>$tmp->marque</td>";
        echo "      <td>$tmp->model</td>";
        if ($affUser == "Non affectee") {
            echo "      <td bgcolor=\"lime\">$affUser</td>";
        } else {
            echo "      <td><a href='controleurs/Users/selectAffUsers.php?nom=" . $user->Id . "'>$affUser</a></td>";
        }
        echo "      <td>$tmp->Commentaire</td>";
        echo "      <td><a href='controleurs/Telephones/deletePhone.php?ID=".$tmp->Id."'>X</a></td>";
        echo "  </tr>";
        //break;
    }
}
echo "</table>";
echo "<br> $cptTelAffichees telephones affiches";

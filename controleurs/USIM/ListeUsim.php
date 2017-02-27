<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cptSimAffichees = 0;
$dateCourante=date('Y-m-d');

echo "<br> Date Courante = $dateCourante";
        
if (isset($_SESSION['OptionStatusSim'])) {
    $OptionStatusSim = $_SESSION['OptionStatusSim'];
} else {
    $OptionStatusSim = "";
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
echo "      <td>status de SIM</td>";
echo "      <td>$OptionStatusSim</td>";
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

$liste = ClassSIM::getList();

echo "<br> <br> Liste des SIM en base<br>";
echo "<table>";
echo "  <tr>";
echo "      <td>total</td>";
echo "      <td>" . ClassSIM::NbSim() . "</td>";
echo "  </tr>";
echo "  <tr>";
echo "      <td>disponibles</td>";
echo "      <td>" . ClassSIM::NbFreeSim() . "</td>";
echo "  </tr>";
echo "  <tr>";
echo "      <td>actives</td>";
echo "      <td>" . ClassSIM::NbActivesSim() . "</td>";
echo "  </tr>";
echo "</table>";
echo "<br><br>";
// on affiche la liste des sim
echo "<table border=1px>";
echo "  <tr>";
echo "      <th>ICCID</th>";
echo "      <th>User</th>";
echo "      <th>MSISDN</th>";
echo "      <th>ExpDate</th>";
echo "      <th>DR</th>";
echo "      <th>PIN code</th>";
echo "      <th>PUK code</th>";
echo "      <th>suppression</th>";
echo "  </tr>";


$today=time();
$lastmonth=time() + (30 * 24 * 60 * 60);

foreach ($liste as $item) {
    $tmp = ClassSIM::NewByICCID($item['ICCID']);
    $user = ClassUsers::NewById($tmp->User);
    switch ($OptionStatusSim) {// filtrage sur status des SIM
        case 'Toutes' :
            $affiche = 1;
            break;
        case 'Libre' :
            if ($tmp->User <> 0) {
                $affiche = 0;
            } else {
                $affiche = 1;
            }
            break;
        case 'Expiree' :
            if ($dateCourante > $tmp->ExpDate){
                $affiche = 1;
            }else{
                $affiche = 0;
            }
            break;
        case 'Valide' :
            if ($dateCourante <= $tmp->ExpDate){
                $affiche = 1;
            }else{
                $affiche = 0;
            }
            break;
        case 'Affectee' :
            if ($tmp->User == 0) {
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
        $cptSimAffichees += 1;
        if ($user <> null) {
            $affUser = "$user->Nom $user->Prenom";
        } else {
            $affUser = "Non affectee";
        }

        echo "  <tr>";
        echo "      <td><a href='controleurs/USIM/selectUpdateUsim.php?ICCID=" . $tmp->ICCID . "'>$tmp->ICCID</a></td>";
        if ($affUser == "Non affectee") {
            echo "      <td bgcolor=\"lime\">$affUser</td>";
        } else {
            echo "      <td><a href='controleurs/Users/selectAffUsers.php?nom=" . $user->Id . "'>$affUser</a></td>";
        }
        echo "      <td>$tmp->MSISDN</td>";
        $dateSIM=strtotime($tmp->ExpDate);
        $diffToday = $date - $dateSIM;
        $diffLastMonth = $lastmonth - $dateSIM;
        $bgcolor='';
        if ($today > $dateSIM) {
            $bgcolor = "red";
        }else if ($lastmonth > $dateSIM) {
            $bgcolor = "orange";
        }
        if ($bgcolor <> '') {
            echo "      <td bgcolor=\"$bgcolor\">$tmp->ExpDate</td>";
        } else {
            echo "      <td>$tmp->ExpDate</td>";
        }
        echo "      <td>$tmp->DR</td>";
        echo "      <td>$tmp->PIN</td>";
        echo "      <td>$tmp->PUK</td>";
        //echo "      <td><a href='controleurs/USIM/deleteSIM.php?ICCID=\"".$tmp->ICCID."\"'>X</a></td>";
        echo "      <td><a href='controleurs/USIM/deleteSIM.php?ICCID=".$tmp->ICCID."'>X</a></td>";
        echo "  </tr>";
    }
}
echo "</table>";
echo "<br> $cptSimAffichees Sim affichees";

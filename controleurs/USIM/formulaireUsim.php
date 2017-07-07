<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$dateCourante=date('Y-m-d');
if (isset($_SESSION['CreateUsim'])) {
    $sim = unserialize($_SESSION['CreateUsim']);
} else {
    $sim = new ClassSIM();
}


if (isset($_SESSION['FormUsim'])) {
    $Bouton = $_SESSION['FormUsim'];
    if ($Bouton == 'MAJ'){
        echo "<br>MAJ d'une SIM<br>";
        if ($sim->ExpDate == ""){
            echo "<br>on force ExpDtae a date courante<br>";
            $sim->ExpDate = $dateCourante;
        }
    }else{
        echo "<br>Creation d'une SIM<br>";
        echo "<br>on force CreationDate a date courante<br>";
        $sim->CreationDate=$dateCourante;
    }
} else {
    $Bouton = "??";
}
echo "<br>";
echo "$Bouton d'une SIM";
echo "<br>";

$listeUsers = ClassUsers::getList();

echo "<form method='POST' action='controleurs/USIM/gestionUsim.php'>";
echo "  <table>";
echo "      <tr>";
echo "          <td>ICCID</td>";
echo "          <td><input name='ICCID' value='$sim->ICCID'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>User</td>";
echo "          <td>";
echo "              <select name='User' value='$sim->User'>";
echo "                  <option value=0></option>";
foreach ($listeUsers as $item) {
    $user = ClassUsers::NewById($item['Id']);
    if ($sim->User == $user->Id) {
        $selected = " selected='selected'";
    } else {
        $selected = "";
    }

    echo "              <option value=$user->Id $selected>$user->Nom $user->Prenom</option>";
}
echo "          </td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>MSISDN</td>";
echo "          <td><input name='MSISDN' value='$sim->MSISDN'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>DR</td>";
echo "          <td><input name='DR' value='$sim->DR'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>CreationDate</td>";
echo "          <td><input name='CreationDate' value='$sim->CreationDate'></td>";
echo "      </tr>";echo "      <tr>";
echo "          <td>ExpDate</td>";
echo "          <td><input name='ExpDate' value='$sim->ExpDate'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>PIN</td>";
echo "          <td><input name='PIN' value='$sim->PIN'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>PUK</td>";
echo "          <td><input name='PUK' value='$sim->PUK'></td>";
echo "      </tr>";
echo "  </table>";
echo "  <input type='submit' value='$Bouton en base'>";
echo "</form>";

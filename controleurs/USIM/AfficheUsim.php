<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo"<br>debut de AfficheUsim.php";

$Iccid = "";
$Msisdn = "";
$User = "";
if (isset($_SESSION['ICCID']) || isset($_SESSION['MSISDN']) || isset($_SESSION['SIMUser'])) {
    if (isset($_SESSION['ICCID'])) {
        $Iccid = $_SESSION['ICCID'];
        $Id = $Iccid;
        //echo "<br>ICCID positionne avec : $Id";
    }
    if (isset($_SESSION['MSISDN'])) {
        $Msisdn = $_SESSION['MSISDN'];
        $Id = $Msisdn;
        //echo "<br>MSISDN positionne avec : $Id";
    }
    if (isset($_SESSION['SIMUser'])) {
        $User = $_SESSION['SIMUser'];
        $Id = $User;
        //echo "<br>SIMUser positionne avec : $Id";
    } else {
        $user = NULL;
    }
} else {
    $Id = NULL;
    echo "<br>Saisissez l'ICCID ou le MSISDN recherche";
    echo "<form method='POST' action='controleurs/USIM/selectAffUsim.php'>";
    echo "  <table border=1px>";
    echo "      <tr>";
    echo "          <td>ICCID : </td>";
    echo "          <td><input name='ICCID' size=50 /></td>";
    echo "      <tr>";
    echo "      <tr>";
    echo "          <td>MSISDN : </td>";
    echo "          <td><input name='MSISDN' size=50 /></td>";
    echo "      <tr>";
    echo "      <tr>";
    echo "          <td>User : </td>";
    echo "          <td><input name='User' size=50 /></td>";
    echo "      <tr>";
    echo "  <table>";
    echo "  <input type=submit value='recherche'/>";
    echo "</form>";
}

$affiche = 0;
$ListeSim = array();

if ($Id <> NULL) {

    //echo "<br>on affiche le resultat";

    if (($Iccid != "") || ($Msisdn != "") || ($User != "")) {
        //echo "<br>recherche par ICCID($Iccid) ou MSISDN($Msisdn) ou User($User)";
        $ListeSim = ClassSIM::NewById($Iccid, $Msisdn, $User);
        if ($ListeSim != null) {
            //echo "<br>Sim trouvee : $Sim->ICCID";
            $affiche = 1;
        } else {
            //echo "<br> Pas de sim trouvee avec ces informations";
        }
    }
}
//echo "<br> Liste des SIM : <br>";
//print_r($ListeSim);
//echo "<br>";
if ($affiche == 1) {
    echo "<table border=1px>";
    echo "  <tr>";
    echo "      <th>ICCID</th>";
    echo "      <th>MSISDN</th>";
    echo "      <th>ExpirationDate</th>";
    echo "      <th>PIN</th>";
    echo "      <th>PUK</th>";
    echo "      <th>User</th>";
    echo "  </tr>";
    foreach ($ListeSim as $Sim) {
        //echo "<br> SIM : <br>";
        //print_r($Sim);
        //echo "<br>";
        $User = ClassUsers::NewById($Sim['User']);
        echo "  <tr>";
        echo "      <td>" . $Sim['ICCID'] . "</td>";
        echo "      <td>" . $Sim['MSISDN'] . "</td>";
        echo "      <td>" . $Sim['ExpDate'] . "</td>";
        echo "      <td>" . $Sim['PIN'] . "</td>";
        echo "      <td>" . $Sim['PUK'] . "</td>";
        if ($User <> null) {
            echo "  <td>$User->Nom $User->Prenom</td>";
        } else {
            echo "  <td>Non affectee</td>";
        }
        echo "  </tr>";
    }
    echo "</table>";
} else {
    echo "<br> Aucune SIM trouvees";
}

unset($_SESSION['ICCID']);
unset($_SESSION['MSISDN']);
unset($_SESSION['SIMUser']);

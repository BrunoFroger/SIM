<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo"<br>debut de AfficheUsim.php";

$TelId = "";
$Msisdn = "";
$User = "";
if (isset($_SESSION['TelId']) || isset($_SESSION['IMEI']) || isset($_SESSION['User'])) {
    
    if (isset($_SESSION['TelId'])) {
        $TelId = $_SESSION['TelId'];
        $Id = $TelId;
    }
    if (isset($_SESSION['IMEI'])) {
        $IMEI = $_SESSION['IMEI'];
        $Id = $IMEI;
    }
    if (isset($_SESSION['User'])) {
        $User = $_SESSION['User'];
        $Id = $User;
    } else {
        $user = NULL;
    }
} else {
    $Id = NULL;
    echo "<br>Saisissez l'ICCID ou le MSISDN recherche";
    echo "<form method='POST' action='controleurs/USIM/selectAffTel.php'>";
    echo "  <table border=1px>";
    echo "      <tr>";
    echo "          <td>TelId : </td>";
    echo "          <td><input name='TelId' size=50 /></td>";
    echo "      <tr>";
    echo "      <tr>";
    echo "          <td>IMEI : </td>";
    echo "          <td><input name='IMEI' size=50 /></td>";
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
$ListeTel = array();

if ($Id <> NULL) {

    //echo "<br>on affiche le resultat";

    if (($TelId != "") || ($Msisdn != "") || ($User != "")) {
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
    echo "      <th>Commentaire</th>";
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
        echo "      <th>User</th>";
        if ($User <> null) {
            echo "  <td>$User->Nom $User->Prenom</td>";
        } else {
            echo "  <td>Non affectee</td>";
        }
        echo "      <td>" . $Sim['Commentaire'] . "</td>";
        echo "  </tr>";
    }
    echo "</table>";
} else {
    echo "<br> Aucun Telephones trouve";
}

unset($_SESSION['ICCID']);
unset($_SESSION['MSISDN']);
unset($_SESSION['SIMUser']);

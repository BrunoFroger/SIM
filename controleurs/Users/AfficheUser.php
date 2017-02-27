<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//echo"<br>debut de AfficheUser.php";
if (isset($_SESSION['OptionStatusSim'])) {
    $OptionStatusSim = $_SESSION['OptionStatusSim'];
}  else {
    $OptionStatusSim = "";
}

if (isset($_SESSION['UserId'])) {
    $Id = $_SESSION['UserId'];
    //echo "<br>session(UserId) = ". print_r($Id);
    echo "<br><br>";
} else {
    $Id = NULL;
    echo "<br>Saisissez le nom du user recherche";
    echo "<form method='POST' action='controleurs/Users/selectAffUsers.php'>";
    echo "  <input name='nom' size=50 />";
    echo "  <input type=submit value='recherche'/>";
    echo "</form>";
}

if ($Id <> NULL) {

    $tmp = ClassUsers::NewById($Id);

    // on affiche le user concerné
    echo "<table border=1px>";
    echo "  <tr>";
    echo "      <th>Id</th>";
    echo "      <th>Nom</th>";
    echo "      <th>Prenom</th>";
    echo "      <th>Societe</th>";
    echo "      <th>Service</th>";
    echo "      <th>Email</th>";
    echo "  </tr>";
    echo "  <tr>";
    echo "      <td>$tmp->Id</td>";
    echo "      <td>$tmp->Nom</td>";
    echo "      <td>$tmp->Prenom</td>";
    echo "      <td>$tmp->Societe</td>";
    echo "      <td>$tmp->Service</td>";
    echo "      <td>$tmp->Email</td>";
    echo "  </tr>";
    echo "</table>";

    // on afffiche la liste de ses SIM
    echo "<br>Liste des SIMs de cet utilisateur";
    echo "<table border=1px>";
    echo "  <tr>";
    echo "      <th>ICCID</th>";
    echo "      <th>MSISDN</th>";
    echo "      <th>ExpirationDate</th>";
    echo "  </tr>";

    $dateCourante=date('Y-m-d');
    $ListeSIM = ClassSIM::getListbyUser($tmp->Id);
    //print_r($ListeSIM);
    foreach ($ListeSIM as $Iccid) {    
        //print_r($Iccid);
        $Sim = ClassSIM::NewByICCID($Iccid['ICCID']);
        if (($dateCourante <= $Sim->ExpDate) && ($OptionStatusSim = 'Toutes')){
            echo "  <tr>";
            //echo "      <td>$Sim->ICCID</td>";
            echo "      <td><a href='controleurs/USIM/selectUpdateUsim.php?ICCID=" .
            $Sim->ICCID . "&MSISDN=" . $Sim->MSISDN . "'>" . $Sim->ICCID . "</a></td>";
            echo "      <td>$Sim->MSISDN</td>";
            echo "      <td>$Sim->ExpDate</td>";
            echo "  </tr>";
        }
    }
    echo "</table>";

   // on afffiche la liste de ses Telephones
    echo "<br>Liste des telephones de cet utilisateur ";
    //echo "($tmp->Id)";
    echo "<table border=1px>";
    echo "  <tr>";
    echo "      <th>IMEI</th>";
    echo "      <th>marque</th>";
    echo "      <th>model</th>";
    echo "  </tr>";

    $ListeTel = ClassPhone::getListbyUser($tmp->Id);
    //print_r($ListeTel);

    foreach ($ListeTel as $item) {
        //print_r($Iccid);
        $phone = ClassPhone::NewById($item['Id']);
        if ($phone == false){
            echo "erreur ClassPhone::NewById KO";
        }
        echo "  <tr>";
        //echo "      <td>$Sim->ICCID</td>";
        echo "      <td><a href='controleurs/Telephones/selectUpdateTel.php?IMEI=" .
        $phone->IMEI . "'>" . $phone->IMEI . "</a></td>";
        echo "      <td>$phone->marque</td>";
        echo "      <td>$phone->model</td>";
        echo "  </tr>";
    }

    echo "</table>";
 

    echo "<br>Envoi d'un <a href='controleurs/Users/envoiMailRecap.php?Id="
    . $tmp->Id . "'>mail</a> "
    . "recapitulatif des SIM a ce user";
} 

    
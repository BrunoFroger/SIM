<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$listeStatusSim = array('Toutes', 'Libre', 'Expiree', 'Valide', 'Affectee');
$listeStatusTel = array('Tous', 'Libre', 'Affecte');
$listeUsers = ClassUsers::getList();

if (isset($_SESSION['OptionStatusSim'])) {
    $OptionStatusSim = $_SESSION['OptionStatusSim'];
} else {
    $OptionStatusSim = "";
}

if (isset($_SESSION['OptionStatusTel'])) {
    $OptionStatusTel = $_SESSION['OptionStatusTel'];
} else {
    $OptionStatusTel = "";
}

if (isset($_SESSION['OptionSelectUser'])) {
    $OptionSelectUser = $_SESSION['OptionSelectUser'];
} else {
    $OptionSelectUser = "";
}

echo "<br>";
echo "Gestion des Options";
echo "<br><br>";

echo "<form method='POST' action='controleurs/Options/selectOptions.php'>";
echo "  <table border=1px>";
echo "      <tr>";
echo "          <td>selection du status des cartes SIM</td>";
echo "          <td><select name='OptionStatusSim'>";
foreach ($listeStatusSim as $item) {
    if ($OptionStatusSim == $item) {
        $selected = " selected='selected'";
    } else {
        $selected = "";
    }

    echo "              <option value=$item $selected>$item</option>";
}
echo "          </td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>selection du status des telephones</td>";
echo "          <td><select name='OptionStatusTel'>";
foreach ($listeStatusTel as $item) {
    if ($OptionStatusTel == $item) {
        $selected = " selected='selected'";
    } else {
        $selected = "";
    }

    echo "              <option value=$item $selected>$item</option>";
}
echo "          </td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>selection d'un User</td>";
echo "          <td><select name='OptionSelectUser'>";
echo "              <option value=0>Tous</option>";
foreach ($listeUsers as $item) {
    $user = ClassUsers::NewById($item['Id']);
    if ($OptionSelectUser == $item['Id']) {
        $selected = " selected='selected'";
    } else {
        $selected = "";
    }

    echo "              <option value=$user->Id $selected>$user->Nom $user->Prenom</option>";
}
echo "          </td>";
echo "      </tr>";
echo "  </table>";

echo "<br>";
echo "  <input type='submit' value='MAJ des options'>";
echo "</form>";

echo "<br>Import/export de donnees SIM (Liste des Users, SIM et Tel";
echo "<br>Ces fonctions permettent d'importer ou d'exporter les fichiers /tmp/SIM.csv, Phones.csv, Users.csv dans la base";
echo "<br>ATTENTION pas de confirmation sur ces actions";
echo "<br>verifiez le contenu des fichiers SIM.csv, Phones.csv et Users.csv avant de faire un import";
echo "<br><a href=controleurs/USIM/exportCsv.php>export csv</a>";
echo "<br><a href=controleurs/USIM/importCsv.php>import csv</a>";

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_SESSION['CreateTel'])) {
    $phone = unserialize($_SESSION['CreateTel']);
    //echo "<p> on recupere les donnees Tel dans le contexte" . print_r($phone) . "</p>";
} else {
    $phone = new ClassPhone();
}

if (isset($_SESSION['FormTel'])) {
    $Bouton = $_SESSION['FormTel'];
} else {
    $Bouton = "??";
}
echo "<br>";
echo "$Bouton d'un Telephone";
echo "<br>";

$listeUsers = ClassUsers::getList();

echo "<form method='POST' action='controleurs/Telephones/gestionTel.php'>";
echo "  <table>";
echo "      <tr>";
echo "          <td>IMEI</td>";
echo "          <td><input name='IMEI' value='$phone->IMEI'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>marque</td>";
echo "          <td><input name='marque' value='$phone->marque'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>modele</td>";
echo "          <td><input name='model' value='$phone->model'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>User</td>";
echo "          <td>";
echo "              <select name='TelUser' value='$phone->TelUser'>";
echo "                  <option value=0></option>";
foreach ($listeUsers as $item) {
    $user = ClassUsers::NewById($item['Id']);
    if ($phone->TelUser == $user->Id) {
        $selected = " selected='selected'";
    } else {
        $selected = "";
    }

    echo "              <option value=$user->Id $selected>$user->Nom $user->Prenom</option>";
}
echo "          </td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>Commentaire</td>";
echo "          <td><input name='Commentaire' value='$phone->Commentaire'></td>";
echo "      </tr>";
echo "  </table>";
echo "  <input type='submit' value='$Bouton en base'>";
echo "</form>";

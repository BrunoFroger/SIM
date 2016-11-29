<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (isset($_SESSION['CreateUser'])) {
    $user = unserialize($_SESSION['CreateUser']);
} else {
    $user = new ClassUsers();
}

if (isset($_SESSION['FormUser'])) {
    $Bouton = $_SESSION['FormUser'];
} else {
    $Bouton = "??";
}
echo "<br>";
echo "$Bouton d'un user";
echo "<br>";

echo "<form method='POST' action='controleurs/Users/gestionUser.php'>";
echo "  <table>";
echo "      <tr>";
echo "          <td>Nom</td>";
echo "          <td><input name='Nom' value='$user->Nom'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>Prenom</td>";
echo "          <td><input name='Prenom' value='$user->Prenom'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>Societe</td>";
echo "          <td><input name='Societe' value='$user->Societe'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>Service</td>";
echo "          <td><input name='Service' value='$user->Service'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td>Email</td>";
echo "          <td><input name='Email' value='$user->Email'></td>";
echo "      </tr>";
echo "  </table>";
echo "  <input type='submit' value='$Bouton en base'>";
echo "</form>";

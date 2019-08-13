<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$liste = ClassUsers::getList();

echo "<br> Liste des Users en base";
echo "<br><br>";
// on affiche la liste des users
echo "<table border=1px>";
echo "  <tr>";
//echo "      <th>Id</th>";
echo "      <th>Nom</th>";
echo "      <th>Prenom</th>";
echo "      <th>Societe</th>";
echo "      <th>Service</th>";
echo "      <th>Email</th>";
echo "      <th>Nb SIM</th>";
echo "      <th>Nb Tel</th>";
echo "      <th>Suppression</th>";
echo "  </tr>";

foreach ($liste as $user) {
    $tmp = ClassUsers::NewById($user['Id']);
    $nbSim = ClassSIM::NbSimByUser($tmp->Id);
    $nbTel = ClassPhone::NbTelByUser($tmp->Id);
    echo "  <tr>";
    //echo "      <td>$tmp->Id</td>";
    echo "      <td><a href='controleurs/Users/selectAffUsers.php?nom=" . $tmp->Id . "'>".$tmp->Nom."</a></td>";
    echo "      <td>$tmp->Prenom</td>";
    echo "      <td>$tmp->Societe</td>";
    echo "      <td>$tmp->Service</td>";
    echo "      <td>$tmp->Email</td>";
    echo "      <td style=\"text-align:center\">$nbSim</td>";
    echo "      <td style=\"text-align:center\">$nbTel</td>";
    echo "      <td><a href='controleurs/Users/deleteUser.php?ID=".$tmp->Id."'>X</a></td>";
    echo "  </tr>";
}
echo "</table>";

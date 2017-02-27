<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$liste = ClassPhone::getRequeteList("select marque,model, count(*) as nb from Phones u group by u.marque,u.model");
//print_r($liste);
echo "<br> nombre de telephones par modele";
echo "<br><br>";
// on affiche la liste des users
echo "<table border=1px>";
echo "  <tr>";
echo "      <th>modele</th>";
echo "      <th> Nb </th>";
echo "  </tr>";

foreach ($liste as $item) {
    echo "  <tr>";
    echo "      <td>$item[marque] $item[model]</td>";
    echo "      <td style=\"text-align:center\">$item[nb]</td>";
    echo "  </tr>";
}
echo "</table>";

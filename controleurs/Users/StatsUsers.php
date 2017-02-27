<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$listeServices = ClassUsers::getRequeteList("select service, count(*) as nb from Users u group by u.service");
//print_r($listeServices);
echo "<br> nombre d'utilisateurs par service";
echo "<br><br>";
// on affiche la liste des users
echo "<table border=1px>";
echo "  <tr>";
echo "      <th>Service</th>";
echo "      <th>Nb Users</th>";
echo "  </tr>";

foreach ($listeServices as $service) {
    echo "  <tr>";
    echo "      <td>$service[service]</td>";
    echo "      <td style=\"text-align:center\">$service[nb]</td>";
    echo "  </tr>";
}
echo "</table>";

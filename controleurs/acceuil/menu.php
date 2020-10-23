<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$taille_menu=250;

if (isset($_SESSION['sousMenu'])) {
    $sousMenu = $_SESSION['sousMenu'];
}  else {
    $sousMenu = "";
}
echo "<p>$sousMenu<p>";
echo "<table>";
echo "<tr>";
echo "  <td width=$taille_menu>";
if ($sousMenu == 'User'){
    echo "  (--<a href=controleurs/Users/selectUsers.php>gestion des users</a>--)";
}else{
    echo "  <a href=controleurs/Users/selectUsers.php>gestion des users</a>";
}
echo "  </td>";
echo "  <td width=$taille_menu>";
if ($sousMenu == 'Usim'){
    echo "  (--<a href=controleurs/USIM/selectSIM.php>gestion des SIM</a>--)";
}else{
    echo "  <a href=controleurs/USIM/selectSIM.php>gestion des SIM</a>";
}
echo "  </td>";
echo "  <td width=$taille_menu>";
if ($sousMenu == 'Tel'){
    echo "  (--<a href=controleurs/Telephones/selectTEL.php>gestion des Telephones</a>--)";
}else{
    echo "  <a href=controleurs/Telephones/selectTEL.php>gestion des Telephones</a>";
}
echo "  </td>";
echo "  <td width=$taille_menu>";
if ($sousMenu == 'Options'){
    echo "  (--<a href=controleurs/Options/selectOptions.php>gestion des Options</a>--)";
}else{
    echo "  <a href=controleurs/Options/selectOptions.php>gestion des Options</a>";
}
echo "  </td>";
echo "</tr>";

switch ($sousMenu) {
    case 'User':
        echo "<tr>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Users/selectAffUsers.php>recherche d'un user</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Users/selectListUser.php>affichage de la liste des users</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Users/selectCreateUser.php>creation d'un user</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Users/selectUpdateUser.php>mise a jour d'un user</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Users/selectStatUsers.php>statistiques sur les users</a>";
        echo "  </td>";
        echo "</tr>";
        break;
    case 'Usim':
        echo "<tr>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/USIM/selectAffUsim.php>recherche d'une SIM</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/USIM/selectListUSim.php>affichage de la liste des SIM</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/USIM/selectCreateUsim.php>creation d'une SIM</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/USIM/selectUpdateUsim.php>mise a jour d'une SIM</a>";
        echo "  </td>";
        echo "</tr>";
        break;
    case 'Tel':
        echo "<tr>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Telephones/selectAffTel.php>recherche d'un Telephone</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Telephones/selectListTel.php>affichage de la liste des Telephones</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Telephones/selectCreeTel.php>Creation d'un Telephone</a>";
        echo "  </td>";
        echo "  <td width=$taille_menu>";
        echo "      <a href=controleurs/Telephones/selectStatsTels.php>statistiques sur les telephones</a>";
        echo "  </td>";
        echo "</tr>";
        break;
    default :
        echo "<tr>";
        echo "  <td>";
        echo "    Sous menu indeterminable";
        echo "  </td>";
        echo "</tr>";
        break;
}
echo "</table>";

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo "<br>On entre dans l'affichage du corps ";

if (isset($_SESSION['affichageCorps'])) {

    switch ($_SESSION['affichageCorps']) {
        
        //    bloc des USERS
        case 'affUser':
            include 'controleurs/Users/AfficheUser.php';
            break;
        case 'affListeUsers':
            include 'controleurs/Users/ListeUsers.php';
            break;
        case 'createUser':
            $_SESSION['FormUser']='creation';
            include 'controleurs/Users/formulaireUser.php';
            break;
        case 'updateUser':
            $_SESSION['FormUser']='MAJ';
            include 'controleurs/Users/formulaireUser.php';
            break;
        
        // Bloc des USIM
        case 'affUsim':
            include 'controleurs/USIM/AfficheUsim.php';
            break;
        case 'affListeUsim':
            include 'controleurs/USIM/ListeUsim.php';
            break;
        case 'createUsim':
            $_SESSION['FormUsim']='creation';
            include 'controleurs/USIM/formulaireUsim.php';
            break;
        case 'updateUsim':
            $_SESSION['FormUsim']='MAJ';
            include 'controleurs/USIM/formulaireUsim.php';
            break;
        
        // OPTIONS
        case 'Options':
            include 'controleurs/Options/formulaireOptions.php';
            break;

        // Bloc des Telephones
        case 'affTel':
            include 'controleurs/Telephones/AfficheTel.php';
            break;
        case 'affListeTel':
            include 'controleurs/Telephones/ListeTel.php';
            break;
        case 'creeTel':
            $_SESSION['FormTel']='creation';
            include 'controleurs/Telephones/formulaireTel.php';
            break;
        case 'UpdateTel':
            $_SESSION['FormTel']='MAJ';
            include 'controleurs/Telephones/formulaireTel.php';
            break;
        case '' :
            echo "Selectionnez un sous menu";
            break;
        default:
            echo "Sous menu inconnu";
            break;
    }
}

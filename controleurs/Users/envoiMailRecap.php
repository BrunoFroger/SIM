<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$myIncludePath = '/var/www/SIM/';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/Users/ClassUsers.php';
include_once 'modeles/USIM/ClassSIM.php';
include_once 'modeles/Phones/ClassPhone.php';

$ficMail="/tmp/SIM/mail.txt";

if (isset($_GET['Id'])) {
    $user = ClassUsers::NewById($_GET['Id']);
    if ($user <> null) {
        $destinataire = $user->Email;
        $sujet = "SIM affected to you";
        $expediteur = "bruno.froger@orange.com";
        $contenu = "Hello,"
                . "<br><br> "
                . "You are using devices send to you for test purpose, "
                . "<br>find here the list identified to your name"
                . "<br><br>list of SIM"
                . "<br>";
        $ListeSIM = ClassSIM::getListbyUser($user->Id);
        //print_r($ListeSIM);
        $contenu = $contenu .  "<table border=1px>";
        $contenu = $contenu .  "  <tr>";
        $contenu = $contenu .  "      <th>ICCID</th>";
        $contenu = $contenu .  "      <th>MSISDN</th>";
        $contenu = $contenu .  "      <th>ExpirationDate</th>";
        $contenu = $contenu .  "  </tr>";
        foreach ($ListeSIM as $Iccid) {
            //print_r($Iccid);
            $Sim = ClassSIM::NewByICCID($Iccid['ICCID']);
            $contenu = $contenu . "  <tr>";
            //$contenu = $contenu . "      <td>$Sim->ICCID</td>";
            $contenu = $contenu . "      <td>$Sim->ICCID</td>";
            $contenu = $contenu . "      <td>$Sim->MSISDN</td>";
            $contenu = $contenu . "      <td>$Sim->ExpDate</td>";
            $contenu = $contenu . "  </tr>";
        }
        $contenu = $contenu . "</table>";

        $contenu = $contenu . "<br><br>list of Phones"
                . "<br>";
        $ListeTel = ClassPhone::getListbyUser($user->Id);
        print_r($ListeTel);
        $contenu = $contenu .  "<table border=1px>";
        $contenu = $contenu .  "  <tr>";
        $contenu = $contenu .  "      <th>IMEI</th>";
        $contenu = $contenu .  "      <th>marque</th>";
        $contenu = $contenu .  "      <th>model</th>";
        $contenu = $contenu .  "  </tr>";
        foreach ($ListeTel as $item) {
            echo "<br> traitement d'un item telephone";
            print_r($item);
            $tel = ClassPhone::NewById($item['Id']);
            $contenu = $contenu . "  <tr>";
            $contenu = $contenu . "      <td>$tel->IMEI</td>";
            $contenu = $contenu . "      <td>$tel->marque</td>";
            $contenu = $contenu . "      <td>$tel->model</td>";
            $contenu = $contenu . "  </tr>";
        }
        $contenu = $contenu . "</table>";


        $contenu = $contenu . "<br><br>Best regards,";
        $contenu = $contenu . "<br><br>Bruno Froger";

        file_put_contents($ficMail, "to: $destinataire\n");
        file_put_contents("$ficMail", "from: ORANGE SOFT Team <SIM.SOFT@orange-labs.fr>\n", FILE_APPEND);
        file_put_contents("$ficMail", "subject: $sujet\n", FILE_APPEND);
        file_put_contents("$ficMail", "<br>message from $expediteur<br>\n", FILE_APPEND);
        file_put_contents("$ficMail", "<br>$contenu\n", FILE_APPEND);
        $cmd = "mutt -H - -n "
                . " -e 'set ssl_starttls=no'"
                . " -e 'set smtp_url=\"smtp://10.194.112.86\"'"
                . " -e 'set content_type=\"text/html\"'"
                . " -e 'set hostname=\"orange-labs.fr\"'"
                . " < $ficMail";
        shell_exec($cmd);
        //echo "<br> commande du mail envoyé : " . $cmd;
        //$ficMail = shell_exec("cat $ficMail");
        echo "$contenu";

        echo "<br> <br> Mail envoye<br>";
    } else {
        echo "<br>Impossible d'envoyer le mail ; Id inconnu";
    }
} else {
    echo "<br>Impossible d'envoyer le mail ; Id manquant";
}

echo "<a href=/SIM/index.php>Continuer</a>";
//header("location: /SIM");


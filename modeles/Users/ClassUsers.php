<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassUsers
 *
 * @author Julien
 */
include_once 'librairies/configuration/SIM_conf.php';

class ClassUsers {

    public $Id;
    public $Nom;
    public $Prenom;
    public $Societe;
    public $Service;
    public $Email;

    static Public function NewCreate($Nom, $Prenom, $Societe, $Service, $DateEmprunt, $Email) {
        $tmp = new ClassUsers();
        $tmp->Nom - $Nom;
        $tmp->Prenom = $Prenom;
        $tmp->Societe = $Societe;
        $tmp->Service = $Service;
        $tmp->Email = $Email;
        $tmp->createBase();
    }

    static public function NewById($Id) {
        $tmp = new ClassUsers();
        if ($tmp->getById($Id)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function NewIdByName($Nom) {
        $tmp = new ClassUsers();
        if ($tmp->getByName($Nom)) {
            return $tmp->Id;
        } else {
            return null;
        }
    }

    static public function Exist($user) {
        $tmp = new ClassUsers();
        if ($tmp->existe($user->Nom ,$user->Prenom,$user->Email)) {
            return $tmp->Id;
        } else {
            return null;
        }
    }

    static public function getList() {
        $requete = "select Id from Users order by Nom";
        //echo ("<p>requete = $requete </p>");
        return ClassUsers::getRequeteList($requete);
    }

    private function existe($nom, $prenom, $email) {
        $requete = "select * from Users where (Nom='$nom' and Prenom ='$prenom') or Email='$email'";
        return $this->getRequete($requete);
    }

    private function getById($Id) {
        $requete = "select * from Users where Id='$Id'";
        return $this->getRequete($requete);
    }

    private function getByName($Nom) {
        //$requete = "select * from Users where Nom='$Nom'";
        $requete = "select * from Users where Nom LIKE '%$Nom%'";
        //$requete = "select * from Users where (Nom LIKE '%$Nom%') or (Prenon LIKE '%$Nom%')";
        return $this->getRequete($requete);
    }

    private function getRequete($requete) {
        //echo ("<p>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mesItems = $dbh->query($requete);
            $dbh = null;
            //echo ("<p>requete executee</p>");
            $mesItems->setFetchMode(PDO::FETCH_ASSOC);
            if ($mesItems->rowCount() > 0) {
                foreach ($mesItems as $monItem) {
                    $this->Id = $monItem['Id'];
                    $this->Nom = $monItem['Nom'];
                    $this->Prenom = $monItem['Prenom'];
                    $this->Societe = $monItem['Societe'];
                    $this->Service = $monItem['Service'];
                    $this->Email = $monItem['Email'];
                }
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "une erreur est survenue : " . $e->getMessage();
            return false;
        }
    }

    public function getRequeteList($requete) {
        $listItems = array();
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mesItems = $dbh->query($requete);
            $dbh = null;
            //echo ("<p>requete executee</p>");
            //print_r($mesItems);
            $mesItems->setFetchMode(PDO::FETCH_ASSOC);
            if ($mesItems->rowCount() > 0) {
                foreach ($mesItems as $monItem) {
                    array_push($listItems, $monItem);
                }
                //print_r($listItems);
                return $listItems;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "une erreur est survenue : " . $e->getMessage();
            return false;
        }
    }

    function createBase() {
        $requete = "insert into Users (Nom, Prenom, Societe, Service, Email) "
                . "values ('$this->Nom', '$this->Prenom', "
                . "'$this->Societe', '$this->Service', "
                . "'$this->Email')";
        //echo ("<p>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo ("<p>cnx base OK</p>");
            $mesItems = $dbh->query($requete);
            if ($mesItems != false) {
                $dbh = null;
                //echo ("<p>requete executee</p>");
                $mesItems->setFetchMode(PDO::FETCH_ASSOC);
                $this->getById($this->Id);
                return true;
            } else {
                $dbh = null;
                //echo ("<p>erreur sur requete</p>");
                return false;
            }
        } catch (PDOException $e) {
            echo "<p>une erreur est survenue lors de la creation du user : " . $e->getMessage();
            return false;
        }
        return false;
    }

    function updateBase() {
        $requete = "update Users set Nom='$this->Nom', "
                . "Prenom='$this->Prenom', "
                . "Societe='$this->Societe', "
                . "Service='$this->Service', "
                . "Email='$this->Email' "
                . "where Id='$this->Id' ";
        echo ("<p>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo ("<p>cnx base OK</p>");
            $mesItems = $dbh->query($requete);
            if ($mesItems != false) {
                $dbh = null;
                //echo ("<p>requete executee</p>");
                $mesItems->setFetchMode(PDO::FETCH_ASSOC);
                $this->getById($this->Id);
                return true;
            } else {
                $dbh = null;
                //echo ("<p>erreur sur requete</p>");
                return false;
            }
        } catch (PDOException $e) {
            echo "<p>une erreur est survenue lors de la mise a jour du user : " . $e->getMessage();
            return false;
        }
        return false;
    }

}

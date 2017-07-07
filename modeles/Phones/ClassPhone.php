<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassPhone
 *
 * @author Julien
 */
include_once 'librairies/configuration/SIM_conf.php';

class ClassPhone {

    public $Id;
    public $IMEI;
    public $marque;
    public $model;
    public $TelUser;
    public $Commentaire;

    static public function NewById($Id) {
        $tmp = new ClassPhone();
        if ($tmp->getById($Id))
            return $tmp;
        else
            return false;
    }

    static public function getList() {
        $requete = "select Id from Phones order by marque, model";
        //echo ("<p>requete = $requete </p>");
        return ClassPhone::getRequeteList($requete);
    }

    static public function getListbyUser($User) {
        $requete = "select Id from Phones where IdUser='$User' order by marque";
        //echo ("<p>requete = $requete </p>");
        return ClassPhone::getRequeteList($requete);
    }

    static public function NewgetByID($Id) {
        $tmp = new ClassPhone();
        if ($tmp->getByID($Id)) {
            return $tmp;
        } else {
            return null;
        }
        $requete = "select * from Phones where Id = '$Id'";
        return $this->getRequete($requete);
    }

    static public function delete($Id) {
        $requete = "delete from Phones where Id = '$Id' ";
        //echo ("<p>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mesItems = $dbh->query($requete);
            //echo ("<p>requete executee</p>");
            $dbh = null;
            return true;
        } catch (PDOException $e) {
            echo "une erreur est survenue : " . $e->getMessage();
            return null;
        }
    }

    static public function Exist($phone) {
        $tmp = new ClassPhone();
        if ($tmp->existe($phone->IMEI)) {
            return $tmp->IMEI;
        } else {
            return null;
        }
    }

    static public function NbTelByUser($user) {
        $resultat = array();
        $tmp = new ClassPhone();
        $requete = "select * from Phones where IdUser='$user'";
        if ($resultat = $tmp->getRequeteList($requete)) {
            return count($resultat);
        } else {
            return 0;
        }
    }

    static public function NewByIMEI($IMEI) {
        $tmp = new ClassPhone();
        $requete = "select * from Phones where IMEI='$IMEI'";
        if ($tmp->getRequete($requete)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function NbFreeTel() {
        $resultat = array();
        $tmp = new ClassPhone();
        $requete = "select * from Phones where IdUser = '0'";
        if ($resultat = $tmp->getRequeteList($requete)) {
            return count($resultat);
        } else {
            return 0;
        }
    }
 
    private function existe($IMEI) {
        $requete = "select * from Phones where IMEI='$IMEI' ";
        return $this->getRequete($requete);
    }

    private function getById($Id) {
        $requete = "select * from Phones where Id='$Id' ";
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
            //echo "<p>items trouves "  . print_r($mesItems) . "</p>";
            $mesItems->setFetchMode(PDO::FETCH_ASSOC);
            if ($mesItems->rowCount() > 0) {
                foreach ($mesItems as $monItem) {
                    $this->Id = $monItem['Id'];
                    $this->IMEI = $monItem['IMEI'];
                    $this->marque = $monItem['marque'];
                    $this->model = $monItem['model'];
                    $this->TelUser = $monItem['IdUser'];
                    $this->Commentaire = $monItem['Commentaire'];
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
        //echo ("<p>requete(list) = $requete </p>");
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
                //echo "<br> Liste des items sauvegardes";
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

    public function createBase() {
        $requete = "insert into Phones (IMEI, marque, model, IdUser, Commentaire) "
                . "values ('$this->IMEI', '$this->marque', '$this->model', '$this->TelUser', '$this->Commentaire' )";
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
            echo "<p>une erreur est survenue lors de la creation du telephone : " . $e->getMessage();
            return false;
        }
        return false;
    }

    public function updateBase() {
        $requete = "update Phones set "
                . "IMEI='$this->IMEI', "
                . "marque='$this->marque', "
                . "model='$this->model', "
                . "IdUser='$this->TelUser', "
                . "Commentaire='$this->Commentaire' "
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
            echo "<p>une erreur est survenue lors de la mise a jour du telephone : " . $e->getMessage();
            return false;
        }
        return false;
    }

}

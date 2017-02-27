<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassSIM
 *
 * @author Julien
 */
include_once 'librairies/configuration/SIM_conf.php';

class ClassSIM {

    public $ICCID;
    public $User;
    public $MSISDN;
    public $DR;
    public $ExpDate;
    public $PIN;
    public $PUK;

    static public function NewByICCID($Iccid) {
        $tmp = new ClassSIM();
        if ($tmp->getByIccid($Iccid)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function NewById($Iccid, $Msisdn, $user) {
        $tmp = new ClassSIM();
        //echo"<br>Classe SIM : static function NewById ($Iccid, $Msisdn, $user)";
        return $tmp->getById($Iccid, $Msisdn, $user);
    }

    static public function NewByUser($user) {
        $tmp = new ClassSIM();
        if ($tmp->getByUser($user)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function getListbyUser($User) {
        $requete = "select ICCID from USIM where User='$User'";
        //echo ("<p>requete = $requete </p>");
        return ClassSIM::getRequeteList($requete);
    }

    static public function getList() {
        $requete = "select ICCID from USIM order by ExpDate,ICCID";
        //echo ("<p>requete = $requete </p>");
        return ClassSIM::getRequeteList($requete);
    }

    private function getByICCID($Iccid) {
        $requete = "select * from USIM where ICCID='$Iccid'";
        return $this->getRequete($requete);
    }

    static public function Exist($usim) {
        $tmp = new ClassSIM();
        if ($tmp->existe($usim->ICCID)) {
            return $tmp->ICCID;
        } else {
            return null;
        }
    }

    static public function NbSimByUser($user) {
        $resultat = array();
        $tmp = new ClassSIM();
        //$requete = "select * from USIM where User LIKE '%$user%'";
        $requete = "select * from USIM where User='$user'";
        if ($resultat = $tmp->getRequeteList($requete)) {
            return count($resultat);
        } else {
            return 0;
        }
    }

    static public function NbFreeSim() {
        $resultat = array();
        $tmp = new ClassSIM();
        $requete = "select * from USIM where User = '0'";
        if ($resultat = $tmp->getRequeteList($requete)) {
            return count($resultat);
        } else {
            return 0;
        }
    }

    static public function NbSim() {
        $resultat = array();
        $tmp = new ClassSIM();
        $requete = "select * from USIM";
        if ($resultat = $tmp->getRequeteList($requete)) {
            return count($resultat);
        } else {
            return 0;
        }
    }

    static public function NbActivesSim() {
        $resultat = array();
        $tmp = new ClassSIM();
        $dateCourante=date('Y-m-d');
        $requete = "select * from USIM where ExpDate > '$dateCourante'";
        if ($resultat = $tmp->getRequeteList($requete)) {
            return count($resultat);
        } else {
            return 0;
        }
    }

    static public function delete($ICCID) {
        $requete = "delete from USIM where ICCID='$ICCID' ";
        echo ("<p>requete = $requete </p>");
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

    private function existe($ICCID) {
        $requete = "select * from USIM where ICCID='$ICCID' ";
        return $this->getRequete($requete);
    }

    private function getById($Iccid, $Msisdn, $user) {
        //echo"<br>Classe SIM : private function getById ($Iccid, $Msisdn, $user)";
        $requete = "select * from USIM where ICCID LIKE '%$Iccid%' AND MSISDN LIKE '%$Msisdn%' AND User LIKE '%$user%' ";
        return $this->getRequeteList($requete);
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
            //print_r($mesItems);
            if ($mesItems->rowCount() > 0) {
                foreach ($mesItems as $monItem) {
                    $this->ICCID = $monItem['ICCID'];
                    $this->User = $monItem['User'];
                    $this->MSISDN = $monItem['MSISDN'];
                    $this->DR = $monItem['DR'];
                    $this->ExpDate = $monItem['ExpDate'];
                    $this->PIN = $monItem['PIN'];
                    $this->PUK = $monItem['PUK'];
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

    private function getRequeteList($requete) {
        //echo ("<p>requete = $requete </p>");
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

    function createBase() {
        $requete = "insert into USIM (ICCID, User, MSISDN, DR, ExpDate, PIN, PUK) "
                . "values ('$this->ICCID', '$this->User', "
                . "'$this->MSISDN', '$this->DR', "
                . "'$this->ExpDate', '$this->PIN', "
                . "'$this->PUK')";
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
                $this->getById($this->ICCID, $this->MSISDN, $this->User);
                return true;
            } else {
                $dbh = null;
                //echo ("<p>erreur sur requete</p>");
                return false;
            }
        } catch (PDOException $e) {
            echo "<p>une erreur est survenue lors de la creation de la SIM : " . $e->getMessage();
            return false;
        }
        return false;
    }

    function updateBase() {
        $requete = "update USIM set "
                . "User='$this->User', "
                . "MSISDN='$this->MSISDN', "
                . "DR='$this->DR', "
                . "ExpDate='$this->ExpDate', "
                . "PIN='$this->PIN', "
                . "PUK='$this->PUK' "
                . "where ICCID='$this->ICCID' ";
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
                $this->getById($this->ICCID, $this->MSISDN);
                return true;
            } else {
                $dbh = null;
                //echo ("<p>erreur sur requete</p>");
                return false;
            }
        } catch (PDOException $e) {
            echo "<p>une erreur est survenue lors de la mise a jour de la SIM : " . $e->getMessage();
            return false;
        }
        return false;
    }

}

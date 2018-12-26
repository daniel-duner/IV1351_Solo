<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root.'/classes/integration/DBH.php');

class GuideHandler{
    private $dbh;

    public function __construct(){
        $this->dbh = new DBH();
    }

    public function getGuides(){
        $sql = "SELECT * FROM guide";
        $result = $this->dbh->safeExecution($sql,array());
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($guides, $row);
        }
        return $guides;
    }

    public function getGuideLanguages($pnr){
        $sql = "SELECT * 
                FROM (SELECT guide.personnr, guide.fnamn, guide.enamn, guide.tel, guide.email, språkkunskap.språk 
                FROM guide 
                INNER JOIN språkkunskap ON guide.personnr=språkkunskap.guide) AS guideinfo 
                WHERE personnr = ?";
        $result = $this->dbh->safeExecution($sql,array($pnr));
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($guides, $row);
        }
        return $guides;
    }

    public function getAddLanguage($pnr){
        $sql = "SELECT namn FROM språk WHERE namn NOT IN (SELECT språk FROM språkkunskap WHERE guide = ?)";
        $result = $this->dbh->safeExecution($sql,array($pnr));
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($guides, $row);
        }
        return $guides;
    }

    public function getAddCompetence($pnr){
        $sql = "SELECT titel, utställningsid FROM utställning WHERE utställningsid NOT IN(SELECT utställning FROM utställningsguide WHERE guide = ?)";
        $result = $this->dbh->safeExecution($sql,array($pnr));
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($guides, $row);
        }
        return $guides;
    }

    public function getRemovableCompetences($pnr){
        $sql = "SELECT titel, utställningsid FROM utställning WHERE utställningsid 
        IN( SELECT utställning FROM utställningsguide WHERE guide = ? 
        AND utställning NOT IN( SELECT distinct(utställning) FROM tur WHERE guide = ?))";
        $result = $this->dbh->safeExecution($sql,array($pnr,$pnr));
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($guides, $row);
        }
        return $guides;
    }
    public function getRemovableLanguages($pnr){
        $sql = "SELECT * FROM språkkunskap WHERE guide = ? 
        AND språk NOT IN( SELECT språk FROM tur WHERE guide = ?)";
        $result = $this->dbh->safeExecution($sql,array($pnr,$pnr));
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($guides, $row);
        }
        return $guides;
    }
    
    public function getGuideCompetences($pnr){
        $sql = "SELECT titel 
        FROM (SELECT utställningsguide.guide, utställning.titel
        FROM utställningsguide
        INNER JOIN utställning ON utställningsguide.utställning=utställning.utställningsid) AS guideinfo 
        WHERE guide = ?";
        $result = $this->dbh->safeExecution($sql,array($pnr));
        $exhibitions = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($exhibitions, $row);
        }
        return $exhibitions;
    }

    public function getGuideTours($pnr){
        $sql = "SELECT * FROM (SELECT utställning.titel, tur.utställning, tur.datum, tur.starttid, tur.guide, tur.språk 
        FROM utställning INNER JOIN tur ON utställning.utställningsid = tur.utställning) AS turinfo WHERE guide = ?
        ORDER BY datum, utställning, starttid";
        $result = $this->dbh->safeExecution($sql,array($pnr));
        $tours = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($tours, $row);
        }
        return $tours;
    }

    public function addLanguage($pnr, $lang){
        $sql = "INSERT INTO språkkunskap (guide, språk) VALUES (?, ?)";
        $result = $this->dbh->safeQuery($sql,array($pnr, $lang));
        return $result;
    }

    public function addCompetence($pnr, $comp){
        $sql = "INSERT INTO utställningsguide (guide, utställning) VALUES (?, ?)";
        $result = $this->dbh->safeQuery($sql,array($pnr, $comp));
        return $result;
    }

    public function removeCompetence($pnr, $comp){
               $sql = "DELETE FROM utställningsguide WHERE guide = ? AND utställning = ?";
               $result = $this->dbh->safeQuery($sql,array($pnr, $comp));
               return $result;
    }

    public function removeLanguage($pnr, $lang){
        $sql = "DELETE FROM språkkunskap WHERE guide = ? AND språk = ?";
        $result = $this->dbh->safeQuery($sql,array($pnr, $lang));
        return $result;
    }
    

}
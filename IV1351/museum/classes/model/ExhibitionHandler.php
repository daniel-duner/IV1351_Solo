<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include $root.'/classes/integration/DBH.php';

class ExhibitionHandler{
    private $dbh;

    public function __construct(){
        $this->dbh = new DBH();
    }

    public function getExhibitions(){
        $sql = "SELECT * FROM utställning";
        $result = $this->dbh->safeExecution($sql,array());
        $exhibitions = array();
        while ($row = mysqli_fetch_assoc($result))
        {
         array_push($exhibitions, $row);
        }
        return $exhibitions;
    }

    public function getExhibition($exhID){
        $sql = "SELECT * FROM utställning WHERE utställningsid = ?";
        $result = $this->dbh->safeExecution($sql,array($exhID));
        $exhibition = array();
        $row = mysqli_fetch_assoc($result);
        array_push($exhibition, $row);
        return $exhibition;
    }

    public function getExhibitionTours($exhID){
        $sql = "SELECT * FROM tur WHERE utställning = ?  ORDER BY datum, starttid";
        $result = $this->dbh->safeExecution($sql,array($exhID));
        $exhibition = array();
        while($row = mysqli_fetch_assoc($result))
        {
         array_push($exhibition, $row);
        }
        return $exhibition;
    }

    public function getExhibitionGuides(){
        $sql = "SELECT personnr, fnamn, enamn FROM guide";
        $result = $this->dbh->safeExecution($sql,array());
        $guides = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $guides[$row['personnr']] = $row['fnamn']." ".$row['enamn'];
        }
        return $guides;
    }

}
/*
$var = 2;
$exh = new ExhibitionHandler();
$result = $exh->getExhibition($var);
echo $result[0]['titel'];
*/
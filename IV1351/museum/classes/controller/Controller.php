<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include $root.'/classes/model/ExhibitionHandler.php';
include $root.'/classes/model/GuideHandler.php';

class Controller{
    private $exh;
    private $gh;

    public function __construct(){
        $this->exh = new ExhibitionHandler();
        $this->gh = new GuideHandler();
    }

    public function getExhibitions(){
        return $this->exh->getExhibitions();
    }

    public function getExhibition($exhID){
        return $this->exh->getExhibition($exhID);
    }
    public function getExhibitionTours($exhID){
        return $this->exh->getExhibitionTours($exhID);
    }

    public function getExhibitionGuides(){
        return $this->exh->getExhibitionGuides();
    }
    public function getGuides(){
        return $this->gh->getGuides();
    }

    public function getGuideLanguages($pnr){
        return $this->gh->getGuideLanguages($pnr);
    }
    
    public function getGuideCompetences($pnr){
        return $this->gh->getGuideCompetences($pnr);
    }
    public function getGuideTours($pnr){
        return $this->gh->getGuideTours($pnr);
    }

    public function getAddLanguage($pnr){
        return $this->gh->getAddLanguage($pnr);
    }
    public function getAddCompetence($pnr){
        return $this->gh->getAddCompetence($pnr);
    }
    public function getRemovableCompetences($pnr){
        return $this->gh->getRemovableCompetences($pnr);
    }

    public function addLanguage($pnr, $lang){
        return $this->gh->addLanguage($pnr, $lang);
    }

    public function addCompetence($pnr, $comp){
        return $this->gh->addCompetence($pnr, $comp);
    }
    public function removeCompetence($pnr, $comp){
        return $this->gh->removeCompetence($pnr, $comp);
    }

    public function getRemovableLanguages($pnr){
        return $this->gh->getRemovableLanguages($pnr);
    }

    public function removeLanguage($pnr, $lang){
        return $this->gh->removeLanguage($pnr, $lang);
    }


}
<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
include $root.'/classes/controller/Controller.php';
$ctrl = new Controller;

if(isset($_GET['getGuideLanguages'])){
  $_SESSION['currentGuide'] = $_GET['pnr'];
  $guideInfo = $ctrl->getGuideLanguages($_GET['pnr']);
  echo \json_encode($guideInfo);
}

if(isset($_GET['getGuideCompetence'])){
    $exhibitions = $ctrl->getGuideCompetences($_GET['pnr']);
    echo \json_encode($exhibitions);
  }

if(isset($_GET['getGuideTours'])){
    $tours = $ctrl->getGuideTours($_GET['pnr']);
    echo \json_encode($tours);
  }
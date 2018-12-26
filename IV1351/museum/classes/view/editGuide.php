<?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    include $root.'/classes/controller/Controller.php';
    $ctrl = new Controller;
    session_start();

    if(isset($_GET['getSelectLang'])){
        $languages = $ctrl->getAddLanguage($_SESSION['currentGuide']);
        echo \json_encode($languages);
    }

    if(isset($_GET['addLanguage'])){
        $attempt = $ctrl->addLanguage($_SESSION['currentGuide'], $_GET['lang']);
        echo \json_encode($attempt);
    }

    if(isset($_GET['getGuideLanguages'])){
        $languages = $ctrl->getGuideLanguages($_SESSION['currentGuide']);
        echo \json_encode($languages);
      }

      if(isset($_GET['getSelectComp'])){
        $competence = $ctrl->getAddCompetence($_SESSION['currentGuide']);
        echo \json_encode($competence);
    }

    if(isset($_GET['addCompetence'])){
        $attempt = $ctrl->addCompetence($_SESSION['currentGuide'], $_GET['comp']);
        echo \json_encode($attempt);
    }

    if(isset($_GET['getGuideCompetences'])){
        $competences = $ctrl->getGuideCompetences($_SESSION['currentGuide']);
        echo \json_encode($competences);
      }

      if(isset($_GET['getRemovableComp'])){
        $competences = $ctrl->getRemovableCompetences($_SESSION['currentGuide']);
        echo \json_encode($competences);
    }

    if(isset($_GET['removeCompetence'])){
        $attempt = $ctrl->removeCompetence($_SESSION['currentGuide'], $_GET['comp']);
        echo \json_encode($attempt);
    }

    if(isset($_GET['getRemovableLang'])){
        $competences = $ctrl->getRemovableLanguages($_SESSION['currentGuide']);
        echo \json_encode($competences);
    }

    if(isset($_GET['removeLanguage'])){
        $attempt = $ctrl->removeLanguage($_SESSION['currentGuide'], $_GET['lang']);
        echo \json_encode($attempt);
    }
 
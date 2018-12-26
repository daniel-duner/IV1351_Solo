<?php    
        $root = $_SERVER['DOCUMENT_ROOT'];
        include $root.'/classes/controller/Controller.php';
        $ctrl = new Controller;

        if(isset($_GET['getExpedition'])){
            $exhID = $_GET['exhID'];
            $exhibiton = $ctrl->getExhibition($exhID);
            echo \json_encode($exhibiton);
        }

        if(isset($_GET['getExpeditionTour'])){
            $exhID = $_GET['exhID'];
            $tours = $ctrl->getExhibitionTours($exhID);
            echo \json_encode($tours);
        }

        if(isset($_GET['getExpeditionGuides'])){
            $guides = $ctrl->getExhibitionGuides();
            echo \json_encode($guides);
        }
    
    

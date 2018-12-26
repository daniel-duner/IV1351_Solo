<?php    
    $root = $_SERVER['DOCUMENT_ROOT'];
    include $root.'/classes/controller/Controller.php';
    $ctrl = new Controller;
    
    $exhibitons = $ctrl->getExhibitions();
    echo \json_encode($exhibitons);
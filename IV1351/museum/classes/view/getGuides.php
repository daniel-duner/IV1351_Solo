<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include $root.'/classes/controller/Controller.php';
$ctrl = new Controller;

$guides = $ctrl->getGuides();
echo \json_encode($guides);
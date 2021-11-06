<?php
require "include.php";
$url = trim($_SERVER['PATH_INFO'],'/');
$url = explode('/',$url);
$route = array("accueil", "contact");
// print_r($url);

$action = $url[0];

// controller
if(!in_array($action,$route)){
    $title = "Page Error";
    $content = "URL introuvable !"; 

}else{
    // echo 'Bienvenu sur la page '.$action;
    $function = "display".ucwords($action);
    $title = "Page".$action;
    $content = $function(); 
    
}
require VIEWS.SP."templates".SP."default.php";




?>
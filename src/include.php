<?php
define("SRC", dirname(__FILE__));
define("ROOT", dirname(SRC));
define("SP", DIRECTORY_SEPARATOR);
define("VIEWS", ROOT.SP."views");
define("MODEL", ROOT.SP."model");
define("CONFIG", ROOT.SP."config");

// import du model
require CONFIG.SP."config.php";
require MODEL.SP."DataLayer.class.php";
$data = new DataLayer();

$var = $data->createCustomers('Raul','raoule@test.com','raoul2020');
$auten = $data->authentifier('raoule@test.com','raoul2020');
print_r($auten); exit();




// Les fonctions appelées par le controller
require "functions.php";




?>
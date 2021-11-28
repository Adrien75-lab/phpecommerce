<?php
//print_r($_SERVER); exit();
define("SRC", dirname(__FILE__));
define("ROOT", dirname(SRC));
define("SP", DIRECTORY_SEPARATOR);
define("VIEWS", ROOT.SP."views");
define("MODEL", ROOT.SP."model");
define("CONFIG", ROOT.SP."config");
define("BASE_URL", dirname(dirname($_SERVER['SCRIPT_NAME'])));
define("TVA", 20);

// import du model
require CONFIG.SP."config.php";
require MODEL.SP."DataLayer.class.php";
$model = new DataLayer();
$category = $model->getCategory();
$data = $model->getProduct(5,1);
//print_r($data);


//$var = $data->createCustomers('Raul','raoule@test.com','raoul2020');
//$auten = $data->authentifier('raoule@test.com','raoul2020');
//print_r($auten); exit();
//$data->updateInfosCustomer(array ('id'=>1,'sexe' =>1,'lastname'=>'Jean','pseudo' =>'jean','firstname'=>'DUPONT', 'email'=>'jean25@gmail.com',));
//$products = $model->getProduct();
//print_r($products); 
//exit();



// Les fonctions appelées par le controller
require "functions.php";

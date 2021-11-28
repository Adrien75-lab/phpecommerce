<?php

class DataLayer{
    private $connexion;


    function __construct(){
        try {
            $this->connexion = new PDO("mysql:host=".HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
            echo "connexion à la base de donnée reussie";
        } catch (PDOException $th) {
            echo $th->getMessage();
            //throw $th;
        }
    }
    /**
     * fonction qui créer un customers en base de données
     *
     * @param pseudo le pseudo du customer
     * @param email l'email du customer
     * @param password le mot de passe du customer
     * @return void
     */
    function createCustomers($pseudo,$email,$password){
        $sql = "INSERT INTO customers (pseudo,email,password) VALUES (:pseudo,:email,:password)";
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':pseudo' => $pseudo,
                ':email' => $email,
                ':password' => sha1($password)
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
            
        } catch (PDOException $th) {
            return NULL;
            //throw $th;
        }
    
    
    
    }
    function authentifier($email,$password){
        $sql="SELECT * FROM customers WHERE email =:email";
        try {
            //code...
            $result = $this->connexion->prepare($sql);
            $result->execute(array(':email' =>$email));
            $data = $result->fetch(PDO::FETCH_ASSOC);
            if($data && ($data['password'] == sha1($password))){
                unset($data['password']);
                return $data;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            //throw $th;
        }

    }
    /**
     * Undocumented function
     *
     * @param idCustomers l'identifiant du customers
     * @param idProduct l'identifiant du produit de la commande
     * @param quantity La quantite du produit commande
     * @param price Le prix de la commance
     * @param TRUE si en cas de commande réalisée avec succées, FALSE si cela a échoué
     * @return NULL s'il y'a une exception déclenchée
     */
    function createOrders($idCustomers,$idProduct,$quantity,$price){
        $sql = "INSERT INTO `orders`(`id_customers`, `id_product`, `quantity`, `price`) 
        VALUES (:id_customers,:id_product,`quantity`,`price`)";
        try {
            //code...
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':id_customers' => $idCustomers,
                ':id_product' => $idProduct,
                ':quantity' => $quantity,
                ':price' => $price
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
            //throw $th;
        }

    }
    // array ('pseudo' =>'jean','firstname'=>'DUPONT')
    function updateInfosCustomer($newInfos){
        $sql = "UPDATE `customers` SET ";
        try {
            foreach($newInfos as $key => $value){
                $sql .= " $key = '$value' ,";
            }
            $sql = substr($sql,0,-1);
            $sql .= " WHERE id = :id";
            $result = $this->connexion->prepare($sql);
            $var =$result->execute(array('id' =>$newInfos['id']));

            if ($var) {
                return TRUE;
                # code...
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }
    function getCategory(){
        $sql = "SELECT * FROM category";
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // Fetch permet de récupérer l'élément courant
            // FetchAll premet de récupérer tous les éléments
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                return $data;
                # code...
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
            //throw $th;
        }
    }
    function getProduct($limit=NULL, $category = NULL,$id=NULL){
        $sql = "SELECT * FROM product ";
        try {
            if(!is_null($id)){
                $sql .= 'WHERE id = '.$id;

            }
            // Lorsque ce n'est pas null, ajoutes moi la requete where
            if(!is_null($category)){
                $sql .= 'WHERE category = '.$category;

            }
            if(!is_null($limit)){
                $sql .= ' LIMIT ' .$limit;

            }
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // Fetch permet de récupérer l'élément courant
            // FetchAll premet de récupérer tous les éléments
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                return $data;
                # code...
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
            //throw $th;
        }
    }
}





?>
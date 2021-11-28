<?php

function displayAccueil()
{
  $result = '<h1> Bienvenu sur la page d\'Accueil</h1>';
  $result .= '<div class="bg-white shadow-sm rounded p-6">
    <form class="" action="actionInscription" method="post">
      <div class="mb-4">
        <h2 class="h4">INSCRIPTION</h2>
      </div>

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="text" name="pseudo" class="form-control " value="Nicolas" required="" placeholder="Entrer votre Pseudo" aria-label="Entrer votre Pseudo">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="email" class="form-control " name="email" value="nicolas@tmail.com" required="" placeholder="Entrez votre adresse email" aria-label="Entrez votre adresse email">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="password" class="form-control " name="password" value="nicolas2020" required="" placeholder="Entrez votre mot de passe" aria-label="Entrez votre mot de passe">
        </div>
      </div>
      <!-- End Input -->

      <button type="submit" class="btn btn-block btn-primary">S\'inscrire</button>
    </form>
  </div>';
  return $result;
}
function displayActionInscription()
{
  global $model;
  //print_r($_REQUEST); exit();
  $pseudo = $_REQUEST["pseudo"];
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  $data = $model->createCustomers($pseudo, $email, $password);
  if ($data) { // inscription réussie
    $data_customer = $model->authentifier($email, $password);
    if ($data_customer) {
      $_SESSION["customer"] = $data_customer;
      return '<p class=" btn btn-success btn-block ">Inscription réussie '.$pseudo.', 
      vous êtes bien connecté</p>' . displayProduit();
    }
  } else { // inscription échouée
    return '<p class=" btn btn-danger btn-block ">Inscription échouée</p>' . displayProduit();
  }
}
function displayActionConnexion(){
  global $model;
  //print_r($_REQUEST); exit();
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  $data_customer = $model->authentifier($email, $password);
  if ($data_customer) {
    $_SESSION["customer"] = $data_customer;
    return '<p class=" btn btn-success btn-block ">Authentification réussie, vous êtes bien connecté
    vous êtes bien connecté</p>' . displayProduit();
  }else { // Connexion échouée
    return '<p class=" btn btn-danger btn-block ">Authentification échouée</p>' . displayProduit();
  }
}
function displayDeconnexion(){
  unset($_SESSION["customer"]);
  return '<p class=" btn btn-success btn-block ">Vous vous êtes bien  déconnecté
      </p>' . displayProduit();
}
function displayContact()
{
  $result = '<h1>Bienvenu sur la page de contact</h1>';
  $result .= '
    <h1 class="text-center">Contactez-Nous !</h1>
    <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail1">Nom : </label>
              <input type="email" class="form-control" id="inputEmail1" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword2">Prenom : </label>
              <input type="text" class="form-control" id="inputPassword2" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Email : </label>
            <input type="text" class="form-control" id="inputAddress" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="inputAddress2">Message : </label>
            <textarea class="form-control" row="5" col="80" required></textarea>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="">
              <label class="form-check-label" for="">
                Se rappeler de moi
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    ';

  return $result;
}
function displayProduit()
{
  global $model;
  $dataProduct = $model->getProduct();
  $result = '<h1>Bienvenu sur la page Produits</h1>';
  foreach ($dataProduct as $key => $value) {
    $result .= '<div class="card" style="width: 18rem; display:inline-block;">
        <img src="' . BASE_URL . SP . "images" . SP . "products" . SP . $value["image"] . '" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">' . $value["name"] . '</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
          <a href="' . BASE_URL . SP . "details" . SP . $value["id"] . '" class="btn btn-primary">Détails</a>
          <a href="' . BASE_URL . SP . "panier" . SP . $value["id"] . '" class="btn btn-success">Acheter</a>
        </div>
      </div>';
  }


  return $result;
}
function displayCategory()
{
  global $model;
  global $url;
  global $category;
  if (isset($url[1]) && is_numeric($url[1]) && $url[1] > 0 && $url[1] <= sizeof($category)) {
    # code...
    $result = '<h1>Bienvenu sur la catégorie ' . $category[$url[1] - 1]["category"] . ' </h1>';
    $dataProduct = $model->getProduct(null, $url[1]);
    foreach ($dataProduct as $key => $value) {
      $result .= '<div class="card" style="width: 18rem; display:inline-block;">
          <img src="' . BASE_URL . SP . "images" . SP . "products" . SP . $value["image"] . '" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">' . $value["name"] . '</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
            <a href="' . BASE_URL . SP . "details" . SP . $value["id"] . '" class="btn btn-primary">Détails</a>
            <a href="' . BASE_URL . SP . "panier" . SP . $value["id"] . '" class="btn btn-success">Acheter</a>
          </div>
        </div>';
    }
  } else {
    $result = '<h1> URL incorrecte </h1>';
  }

  return $result;
}

function displayDetails()
{
  global $model;
  global $url;
  global $category;
  $result = '<h1> Bienvenu sur la page de détails produits </h1>';
  $dataProduct = $model->getProduct(null, null, $url[1]);
  $result .= '
    <div class="row details ">
      <div class="col-md-5 col-12">
      <img src="' . BASE_URL . SP . "images" . SP . "products" . SP . $dataProduct[0]["image"] . '" class="card-img-top" alt="...">

    </div>
    <div class="col-md-5 col-12">
    <h2>' . $dataProduct[0]["name"] . '</h2>
    <p>' . $dataProduct[0]["description"] . '</p>
    <p>Categorie: ' . $category[$dataProduct[0]["category"] - 1]["category"] . '</p>
    
    <a href="' . BASE_URL . SP . "panier" . SP . $dataProduct[0]["id"] . '" class="btn btn-block btn-success">Ajouter au panier</a>
    <a href="' . BASE_URL . SP . "produit" . '" class="btn btn-block btn-primary">Retour à la page Produits</a>
    </div>
    </div>
  ';
  return $result;
}
function displayPanier()
{
  global $model;
  global $url;
  if (isset($url[1])) {
    $idProduit = $url[1];
    $dataProduct = $model->getProduct(null, null, $url[1]);
    $_SESSION["panier"][] = $dataProduct[0];
  }
  if (!isset($_SESSION["panier"]) || sizeof($_SESSION["panier"]) == 0) {
    return '<h1>Votre panier est vide ! </h1>' . displayProduit();
  }
  $result = '<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Description</th>
      <th scope="col">Image </th>
      <th scope="col">Prix </th>
      <th scope="col">Quantité </th>
      <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
  ';
  $total_price = 0;
  foreach ($_SESSION["panier"] as $key => $value) {
    $total_price += $value["price"];
    $result .= '<tr>
    <th scope="row">' . $value["id"] . '</th>
    <td>' . $value["name"] . '</td>
    <td>' . $value["description"] . '</td>
    <td><img src="' . BASE_URL . SP . "images" . SP . "products" . SP . $value["image"] . '" alt="..." width="125" height="150"/></td>
    <td>' . $value["price"] . '€</td>
    <td>1</td>
    <td><a href="' . BASE_URL . SP . "supprimer" . SP . $key . '" class="btn btn-primary">Supprimer</a></td>
    </tr>';
  }
  $total_tva = $total_price * TVA / 100;
  $total_ttc = $total_tva + $total_price;
  $result .= '<tr><td></td><td></td><td></td><td></td><td>Prix total (HT)</td><td>' . number_format($total_price, 2) . '€</td><td></td><tr>
  <tr><td></td><td></td><td></td><td></td><td>Tva (' . TVA . '%)</td><td>' . number_format($total_tva, 2) . '€</td><td></td><tr>
  <tr><td></td><td></td><td></td><td></td><td>Total (TTC)</td><td>' . number_format($total_ttc, 2) . '€</td><td></td><tr>';
  $result .= '</tbody>
             </table>';
  return $result;
}

function displaySupprimer()
{
  global $url;

  //print_r($_SESSION["panier"]);
  if (isset($url[1]) && is_numeric($url[1])) {
    $param = $url[1];
    unset($_SESSION["panier"][$param]);
    header("Location: " . BASE_URL . SP . "panier");
  }
}

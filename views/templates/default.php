<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title> <?php echo $title ?> </title>
    <style>
        .container{
            padding-top: 70px;
        }
    </style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">JSTORE</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL.SP."accueil" ?>">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL.SP."produit" ?>">Produit</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Catégories</a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                    foreach ($category as $key => $value) {
                        echo '<a class="dropdown-item" href="'.BASE_URL.SP."category".SP.$value["id"].'">'.$value["name"].'</a>';
                    }

                ?>
               <!-- <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>-->
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL.SP."contact" ?>">Contact</a>
        </li>
        
        
        </ul>
        <a href="<?php echo BASE_URL.SP."panier" ?>" class="btn btn-outline-success my-2 my-sm-0 mr-2">Panier</a>
        <?php if(!isset($_SESSION["customer"])): ?>
            <form class="form-inline my-2 my-lg-0" action="actionConnexion" method="post">
                <input class="form-control mr-sm-2" name="email" type="email" placeholder="Votre email" aria-label="Search" required>
                <input class="form-control mr-sm-2" name="password" type="password" placeholder="Votre mot de passe" aria-label="Search" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button>
                
            </form>
            <a href="<?php echo BASE_URL.SP."accueil" ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit">Inscription</a>
        <?php endif; ?>
        <?php if(isset($_SESSION["customer"])): ?>
            <a href="<?php echo BASE_URL.SP."profil" ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit">Profil</a>
            <a href="<?php echo BASE_URL.SP."deconnexion" ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit">Déconnexion</a>
        <?php endif; ?>
    </div>
    </nav>
    
    <div class="container">
        <?php echo $content ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
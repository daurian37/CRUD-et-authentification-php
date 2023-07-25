<?php
    # Chargement de la configuration et de la BDD
    require_once(__DIR__ . '/../config/configuration.php');
    require_once(__DIR__ . '/../config/database.php');

    # Chargement de nos fonctions
    require_once(__DIR__ . '/../functions/global.php');
    require_once(__DIR__ . '/../functions/security.php');
    require_once(__DIR__ . '/../functions/categorie.php');
    require_once(__DIR__ . '/../functions/article.php');

    # Récupération des catégories
    $categories = getCategories();

    # Récupération du statut de connexion
    $user = isLoggedIn();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Actunews CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CkEditor JS -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <title>DIGIPART</title>
</head>
<body>

<!-- Menu du site -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">DIGIPART</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <?php foreach ($categories as $category) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="categorie.php?ID=<?= $category['id'] ?>&NOM=<?= $category['nom'] ?>">
                            <?= $category['nom'] ?>
                        </a>
                    </li>
                <?php } // endforeach ?>
            </ul>
            <div class="text-right">
                <?php if($user) { ?>
                    <span class="navbar-text mx-2">
                        Bonjour <strong><?= $user['prenom'] ?></strong>
                    </span>
                    <a class="nav-item btn btn-outline-success mx-2"
                       href="mesArticles.php">Mes articles</a>

                    <a class="nav-item btn btn-outline-warning mx-2"
                       href="creer-un-article.php">Créer un article</a>

                    <a class="nav-item btn btn-outline-primary mx-2"
                       href="deconnexion.php">Déconnexion</a>
                <?php } else { ?>
                    <a class="nav-item btn btn-outline-info mx-2" href="connexion.php">Connexion</a>
                    <a class="nav-item btn btn-outline-warning mx-2" href="inscription.php">Inscription</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
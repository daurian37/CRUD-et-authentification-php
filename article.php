<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');

# Récupération des paramètres
$articleId = $_GET['ID'] ?? 0;

# Récupération des articles de la catégorie
$article = getArticleById($articleId);

?>

    <div class="p-3 mx-auto text-center">
        <h1 class="display-4"><?= $article['reference'] ?></h1>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card shadow-sm">
                        <img class="card-img-top"
                             src="assets/uploads/<?=$article['image']?>"
                             alt="<?= $article['reference'] ?>">
                        <div class="card-body">
                            <div class="card-text">
                                <?= $article['description'] ?>
                            </div>
                        </div>
                    </div> <!-- Fin card -->
                </div>

            </div>
        </div> <!-- Fin container -->
    </div>

<?php
# Inclusion du footer sur la page
require_once(__DIR__ . '/partials/footer.php');

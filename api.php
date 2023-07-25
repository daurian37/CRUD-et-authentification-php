<?php
  # Chargement de la configuration et de la BDD
  require_once(__DIR__ . './config/configuration.php');
  require_once(__DIR__ . './config/database.php');

  # Chargement de nos fonctions
 
  require_once(__DIR__ . './functions/article.php');

$products = getArticles();

// Récupération du paramètre idProduct depuis l'URL
if (isset($_GET['idProduct'])) {
    $idProduct = $_GET['idProduct'];

    // Recherche du produit dans la base de données simulée
    $product = null;
    foreach ($products as $item) {
        if ($item['idProduct'] == $idProduct) {
            $product = $item;
            break;
        }
    }

    // Réponse JSON
    if ($product) {
        header('Content-Type: application/json');
        echo json_encode($product);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'Article non trouvé']);
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Paramètre idProduct manquant']);
}

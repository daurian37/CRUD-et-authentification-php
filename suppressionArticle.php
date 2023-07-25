<?php 
    # Chargement de la configuration et de la BDD
    require_once(__DIR__ . '/config/configuration.php');
    require_once(__DIR__ . '/config/database.php');

    # Chargement de nos fonctions
    require_once(__DIR__ . '/functions/global.php');
    require_once(__DIR__ . '/functions/security.php');
    require_once(__DIR__ . '/functions/article.php');

    deleteArticle($_GET['idArticle']);
	redirection('mesArticles.php');


 ?>
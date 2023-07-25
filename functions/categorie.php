<?php

/**
 * Retourne les catégories du site
 * depuis la base de données.
 */
function getCategories() {
    global $dbh; // Récupération depuis l'espace global.
    $query = $dbh->query('SELECT * FROM categorie');
    return $query->fetchAll();
}

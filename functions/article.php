<?php

/**
 * Permet de retourner tous les
 * articles de la BDD.
 */
function getArticles() {
    global $dbh;
    $query = $dbh->query('
        SELECT *, a.idProduct AS "id"
            FROM article a, auteur au
                WHERE a.auteur_id = au.id
                ORDER BY a.idProduct DESC
    ');
    return $query->fetchAll();
}

/**
 * Permet de retourner un article
 * via son ID dans la base.
 *
 * @param $idArticle
 * @return mixed
 */
function getArticleById($idArticle) {
    global $dbh;
    $query = $dbh->prepare('
        SELECT * FROM article WHERE idProduct = :id
    ');
    $query->bindValue(':id', $idArticle);
    $query->execute();
    return $query->fetch();
}

/**
 * Permet de retourner les articles
 * d'une catégorie.
 *
 * @param $idCategory
 * @return array|false
 */
function getArticlesByCategoryId($idCategory) {
    global $dbh;
    $query = $dbh->prepare('
        SELECT *, a.idProduct AS "id" 
            FROM article a, auteur au
                WHERE a.auteur_id = au.id
                AND a.categorie_id = :id
                ORDER BY a.idProduct DESC
    ');
    $query->bindValue(':id', $idCategory, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}

/**
 * Permet de retourner les articles
 * d'un auteur
 *
 * @param $idAuthor
 */
function getArticlesByAuthorId($idAuthor) {

    global $dbh;
    $query = $dbh->prepare('
        SELECT * FROM article WHERE auteur_id = :id
    ');
    $query->bindValue(':id', $idAuthor);
    $query->execute();
    return $query->fetchAll();
}

/**
 * Permet de retourner un article
 * via son ID dans la base.
 *
 * @param $idAuteur
 * @param $idCategorie
 * @param $reference
 * @param $description
 * @param $image
 */
function addArticle($idAuteur, $idCategorie, $reference, $description, $image, $priceTaxIncl) {
    global $dbh;
    $query = $dbh->prepare('
        INSERT INTO article (reference, description, image, categorie_id, auteur_id, priceTaxIncl )
            VALUES (:reference, :description, :image, :categorie_id, :auteur_id, :priceTaxIncl)
    ');
    
    $query->bindValue(':reference', $reference, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':categorie_id', $idCategorie, PDO::PARAM_INT);
    $query->bindValue(':auteur_id', $idAuteur, PDO::PARAM_INT);
    $query->bindValue(':priceTaxIncl', $priceTaxIncl, PDO::PARAM_INT);
    
    return $query->execute() ? $dbh->lastInsertId() : false;
}

/**
 * Permet de supprimer un article
 * via son ID dans la base.
 *
 * @param $idArticle
 */
function deleteArticle($idArticle) {

    global $dbh;
    $query = $dbh->prepare('
        DELETE FROM article WHERE idProduct = :id
    ');
    $query->bindValue(':id', $idArticle);
    $query->execute();
    return $query->execute();
}



/**
 * Permet de mettre à jour un article
 * via son ID dans la base.
 *
 * @param $idArticle
 * @param $idAuteur
 * @param $idCategorie
 * @param $reference
 * @param $description
 * @param $image
 * @return bool
 */
function updateArticle($idArticle, $idAuteur, $idCategorie, $reference, $description, $image, $priceTaxIncl) {
    global $dbh;
    $query = $dbh->prepare('
        UPDATE article
        SET reference = :reference,
            description = :description,
            image = :image,
            categorie_id = :categorie_id,
            auteur_id = :auteur_id,
            priceTaxIncl = :priceTaxIncl
        WHERE idProduct = :id
    ');

    $query->bindValue(':id', $idArticle, PDO::PARAM_INT);
    $query->bindValue(':reference', $reference, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':categorie_id', $idCategorie, PDO::PARAM_INT);
    $query->bindValue(':auteur_id', $idAuteur, PDO::PARAM_INT);
    $query->bindValue(':priceTaxIncl', $priceTaxIncl, PDO::PARAM_INT);


    return $query->execute();
}

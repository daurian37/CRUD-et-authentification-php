<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');

# Récupération de l'auteur


# Récupération des articles
$idAuthor= $user['id'] ?? 0;
$articles = getArticlesByAuthorId($idAuthor);

?>

	 <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Mes articles</h1>
    </div>

	<table class="table container">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Reférence</th>
      <th scope="col">Image</th>
      <th scope="col">Supprimer</th>
      <th scope="col">Modifier</th>
    </tr>
  </thead>

<?php 

foreach ($articles as $article) { ?>
 
  <tbody>
    <tr>
      <th scope="row"><?= $article['idProduct'] ?></th>

      <td><?= $article['reference'] ?></td>

      <td> 
      	<img class="card-img-top" style="width:50px;"
             src="assets/uploads/<?=$article['image']?>"
             alt="<?= $article['reference'] ?>">
      </td>

       <td>  

       	<a href="suppressionArticle.php?idArticle=<?= $article['idProduct']; ?>"> <button type="submit" class="btn btn-danger" name="suprimer_produit">suprimer</button>
       	</a> 
       </td>

       <td>  

       	<a href="modifierArticle.php?idArticle=<?= $article['idProduct']; ?>"> <button type="submit" class="btn btn-success" name="modifier_produit">modifier</button>
       	</a> 
       </td>
    </tr>
    
  </tbody>


<?php
	
}


 ?> 
</table>

<?php
# Inclusion du footer sur la page
require_once(__DIR__ . '/partials/footer.php');
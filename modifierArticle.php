<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');


# Vérification des droits d'accès
$user = isLoggedIn();
if(!$user) {
    # Utilisateur n'est pas connecté.
    redirection('connexion.php');
}

# Initialisation des variables
$reference = $description = $image = $id_categorie = $priceTaxIncl = null;

if(!empty($_POST)) {

    # Affectation des variables
    foreach ($_POST as $cle => $valeur) {
        $$cle = $valeur;
    }

    # Récupération de l'image
    $image = $_FILES['image'];

    # Chargement de l'image
    # Récupération du fichier temporaire
    $fileTmp = $image['tmp_name'];

    # Récupération de l'extension de l'image
    $extension = pathinfo($image['name'])['extension'];

    # Nom sécurisé de l'image
    $fileName = $reference . '.' . $extension;

    # Mon dossier de destination
    $destination = __DIR__ . '/assets/uploads/' . $fileName;

    # Déplacer le fichier dans la destination
    move_uploaded_file($fileTmp, $destination);

    # J'envoi dans ma BDD le nom de l'image
    $image = $fileName; 

    # Vérification des données
    $errors = [];

} 

if(isset($_POST['idArticle'], $_POST['idUser'], $_POST['id_categorie'], $_POST['reference']
, $_POST['description'], $image, $_POST['priceTaxIncl'])){


    $idArticle = updateArticle($_POST['idArticle'], $_POST['idUser'], $_POST['id_categorie']
    , $_POST['reference'], $_POST['description'], $image, $_POST['priceTaxIncl']);
    
    if($idArticle) {
        redirection('mesArticles.php');
    }

  } 

?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form method="post" enctype="multipart/form-data" class="m-3">
                    <fieldset class="border rounded p-3">
                        <h2 class="text-center">
                            Modifier un article
                        </h2>

                        <input type="hidden" id="idArticle" name="idArticle" value="<?= $_GET['idArticle'] ?>">
                        <input type="hidden" id="idUser" name="idUser" value="<?= $user['id'] ?>">

                        <!-- Reference -->
                        <div class="form-group mt-2">
                            <input type="text" name="reference"
                                   class="form-control <?= isset($errors['reference']) ? 'is-invalid' : '' ?>"
                                   placeholder="Reference de l'article"
                                   id="reference" value="<?= $reference ?>">
                            <div class="invalid-feedback"><?= $errors['reference'] ?? '' ?></div>
                        </div>

                        <!-- Categorie -->
                        <div class="form-group mt-2">
                            <select name="id_categorie" id="id_categorie" class="form-control">
                                <?php foreach (getCategories() as $category) { ?>
                                    <option
                                        <?= ($category['id'] === $id_categorie) ? 'selected' : '' ?>
                                            value="<?= $category['id'] ?>">
                                        <?= $category['nom'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback"><?= $errors['categorie'] ?? '' ?></div>
                        </div>

                         <!-- Prix -->
                         <div class="form-group mt-2">
                            <label for="priceTaxIncl"> Prix de l'article</label>
                            <input type="number" name="priceTaxIncl"
                                   class="form-control <?= isset($errors['priceTaxIncl']) ? 'is-invalid' : '' ?>"
                                   placeholder="Prix de l'article"
                                   id="priceTaxIncl" min = 1 >
                            <div class="invalid-feedback"><?= $errors['priceTaxIncl'] ?? '' ?></div>
                        </div>

                        <!-- Description -->
                        <div class="form-group mt-2">
                        <textarea name="description" id="description"
                                  class="form-control"
                                  placeholder="Description de l'article">
                            
                        </textarea>
                            <script>
                                ClassicEditor.create(document.querySelector('#description'));
                            </script>
                            <div class="invalid-feedback"><?= $errors['description'] ?? '' ?></div>
                        </div>

                        <!-- Image -->
                        <div class="form-group mt-2">
                            <input type="file" name="image"
                                   class="dropify form-control-file <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                                   id="image" value="<?= $image ?>">
                            <div class="invalid-feedback"><?= $errors['image'] ?? '' ?></div>
                        </div>

                        <!-- Bouton -->
                        <div class="d-grid gap-2">
                            <button class="btn mt-4 btn-dark" type="submit">
                                Publier mon article
                            </button>
                        </div>

                    </fieldset>
                </form>
            </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


    <!--form method="post" action="update.php">

    <input type="text" id="test" name="test">
    <button type="submit"> Test</button>
    </form-->
    

<?php
# Inclusion du footer sur la page
require_once(__DIR__ . '/partials/footer.php');
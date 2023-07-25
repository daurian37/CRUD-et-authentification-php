<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');

$nom = $prenom = $email = $password = $confirmPassword = null;
$errors = [];

if (!empty($_POST)) {

    # Affectation des variables
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    # Vérification du nom
    if (empty($nom)) {
        $errors['nom'] = "Veuillez vérifier votre nom.";
    }

     # Vérification du prenom
    if (empty($prenom)) {
        $errors['prenom'] = "Veuillez vérifier votre prenom.";
    }

    # Vérification du mail
    if (empty($email)) {
        $errors['email'] = "Veuillez vérifier votre email.";
    }

    # Vérification du password
    if (empty($password)) {
        $errors['password'] = "Veuillez vérifier votre mot de passe.";
    }

     # Vérification du password de confirmation
    if (empty($confirmPassword)) {
        $errors['confirmPassword'] = "Veuillez vérifier votre mot de passe.";
    }

    # Vérifie si le mail existe déja dans la base de donnés
    if (is_already_in_use('email',$email,'auteur')){
        $errors['email']="Adresse électronique déjà utilisé par un autre auteur";
    }

    # Vérification validité de l'email
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors['email']="Adresse mail invalide";
    } 

    # Taille du mot de passe doit être > 8 caractères
    if(mb_strlen($password) < 8){

        $errors['password']="Mot de passe trop court (Minimum 8 caractères)";
    }

    # Vérification de la corcordance avec le password de confirmation
    if ($password != $confirmPassword){

         $errors['confirmPassword']="Les deux mots de passe ne concordent pas !";
    }

    # Le tableau errors est vide, il n'y a pas d'erreurs...
    if (empty($errors)) {

        # Début du process d'inscription.

        if (register($nom, $prenom, $email, $password, $confirmPassword)) {
            redirection('mesArticles.php');
        } else {
            echo '<p class="container"> oups une erreur s\'est produite.</p>';
        }

    }

}

?>

    <!-- Contenu de la page -->

    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Inscription</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offet-md-3 mx-auto">
                <form method="post" class="form-horizontal">

                    <div class="form-group mt-2">
                        <input type="text" name="nom"
                               class="form-control  <?= isset($errors['nom']) ? 'is-invalid' : '' ?>"
                               value="<?= $nom?? $_GET['nom'] ?? '' ?>" placeholder="Nom.">
                        <div class="invalid-feedback">
                            <?= $errors['nom'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <input type="text" name="prenom"
                               class="form-control  <?= isset($errors['prenom']) ? 'is-invalid' : '' ?>"
                               value="<?= $prenom?? $_GET['prenom'] ?? '' ?>" placeholder="Prenom.">
                        <div class="invalid-feedback">
                            <?= $errors['prenom'] ?? '' ?>
                        </div>
                    </div>


                    <div class="form-group mt-2">
                        <input type="email" name="email"
                               class="form-control  <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                               value="<?= $email ?? $_GET['email'] ?? '' ?>" placeholder="Email.">
                        <div class="invalid-feedback">
                            <?= $errors['email'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <input type="password" name="password"
                               class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                               placeholder="Mot de passe.">
                        <div class="invalid-feedback">
                            <?= $errors['password'] ?? '' ?>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <input type="password" name="confirmPassword"
                               class="form-control <?= isset($errors['confirmPassword']) ? 'is-invalid' : '' ?>"
                               placeholder="Confirmer le mot de passe.">
                        <div class="invalid-feedback">
                            <?= $errors['confirmPassword'] ?? '' ?>
                        </div>
                    </div>

                    <button class="btn btn-block mt-2 btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

<?php
# Inclusion du footer sur la page
require_once(__DIR__ . '/partials/footer.php');
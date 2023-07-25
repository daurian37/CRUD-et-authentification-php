<?php

# Inclusion du header sur la page
require_once(__DIR__ . '/partials/header.php');

$email = $password = null;
$errors = [];

if (!empty($_POST)) {

    # Affectation des variables
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    # Vérification du mail
    if (empty($email)) {
        $errors['email'] = "Veuillez vérifier votre email.";
    }

    # Vérification du password
    if (empty($password)) {
        $errors['password'] = "Veuillez vérifier votre mot de passe.";
    }

    # Le tableau errors est vide, il n'y a pas d'erreurs...
    if (empty($errors)) {

        # Début du process de connexion.
        if (login($email, $password)) {
            redirection('index.php');
        } else {
            $errors['email'] = "Email / Mot de passe incorrect.";
        }

    }

}

?>

    <!-- Contenu de la page -->

    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Connexion</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offet-md-3 mx-auto">
                <form method="post" class="form-horizontal">
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
                    <button class="btn btn-block mt-2 btn-primary">Connexion</button>
                </form>
            </div>
        </div>
    </div>

<?php
# Inclusion du footer sur la page
require_once(__DIR__ . '/partials/footer.php');
<?php


# fonction pour la vérification de l'existence de l'email dans la BDD
if(!function_exists('is_already_in_use')){


    function is_already_in_use($field,$value,$table)
    {
 
        global $dbh;

        $req=$dbh->prepare("SELECT id from $table where $field=?");
        $req->execute([$value]); 

        $count = $req->rowCount();

        $req->closeCursor();

        return $count;
    }
}

/**
 * Inscription d'un utilisateur
 * 
 * @param string $nom
 * @param string $prenom
 * @param string $email
 * @param string $password
 * @return bool
 */
function register($nom,$prenom,$email,$password) 
{
     global $dbh;

   # hachage du password
    $psw = password_hash($password, PASSWORD_BCRYPT);

    # insertion auteur dans la base de données

    $query = $dbh->prepare('INSERT INTO auteur(prenom,nom,email,password) VALUES (?,?,?,?)');

    $user = $query->execute(array($prenom,$nom,$email,$psw));

    $query = $dbh->prepare('
        SELECT * FROM auteur
            WHERE email = :email
    ');
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();

    # Récupération de l'utilisateur dans la base
    $user = $query->fetch();

    if($user && password_verify($password, $user['password'])) {
        # Mettre en session les informateurs du user
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}


/**
 * Connexion d'un utilisateur
 *
 * @param string $email
 * @param string $password
 * @return bool
 */
function
login(string $email, string $password): bool
{
    global $dbh;
    $query = $dbh->prepare('
        SELECT * FROM auteur
            WHERE email = :email
    ');
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();

    # Récupération de l'utilisateur dans la base
    $user = $query->fetch();

    if($user && password_verify($password, $user['password'])) {
        # Mettre en session les informateurs du user
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

/**
 * Déconnexion d'un utilisateur
 */
function logout(): bool
{
    unset($_SESSION['user']);
    return true;
}

/**
 * Vérification du statut de connexion de l'utilisateur.
 *
 * @return false|mixed
 */
function isLoggedIn() {
    return $_SESSION['user'] ?? false;
}
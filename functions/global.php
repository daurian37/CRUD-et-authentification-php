<?php

session_start(); // Démarrage de la session PHP


/**
 * Redirige l'utilisateur sur une
 * nouvelle page.
 *
 * @param $page
 */
function redirection($page){
    header('Location: '.$page);
}
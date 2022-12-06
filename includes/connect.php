<?php

$dbname = "audomavoix";     // nom de la bdd
$dbhost = "localhost";      // url de la bdd
$dbpass = "Greta1234!";           // user de la bdd
$dbuser = "greta";           // mdp de la bdd
// test en try and catch
try {
    // nom de votre choix pour la variable , dsn = data source name
    $dsn = "mysql:dbname=".$dbname.";host=".$dbhost;
    // pdo = connexion entre php et une bdd
    $db = new PDO($dsn, $dbuser, $dbpass);
    // setup de l'utf8 (les accents)
    $db->exec("SET NAMES utf8");
    // configure un attribut pdo::"l'attribut"
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
// renvoie les erreurs
catch (PDOException $e) {
    die($e->getMessage());
}

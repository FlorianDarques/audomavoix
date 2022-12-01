<?php 
if(isset($_SESSION["user"])) {
    header("location: index.php");
}

// si mes input du form en method POST sont différent d'un champ vide (donc plein)
if(!empty($_POST)) {
    if(isset($_POST["name"], $_POST["surname"], $_POST["age"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["age"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirmpassword"]) ) {

        $_SESSION["error"] = [];
        $name = htmlentities($_POST["name"]);
        $surname = htmlentities($_POST["surname"]);
        $age = htmlentities($_POST["age"]);
        $age = (is_numeric($age)) ? (int)$age : 0;

        if(strlen($name) < 2) {
            $_SESSION["error"][] = "Le prénom est trop court";
        }
        if(strlen($surname) < 2) {
            $_SESSION["error"][] = "Le nom est trop court";
        }
        if($age <= 14 || $age >= 99) {
            $_SESSION["error"][] = "l'âge doit être compris entre 14 et 99 ans (compris)";
        }
        if(strlen($pass) < 8) {
            $_SESSION["error"][] = "Le mot de passe doit contenir 8 caractère minimum";
        }
        if($_POST["password"] !== $_POST["confirmpassword"]) {
            $_SESSION["error"][] = "Le prénom est trop court";
        }
        // $email = htmlentities($_POST["email"]);
        // $password = htmlentities($_POST["password"]);
        
    }
}
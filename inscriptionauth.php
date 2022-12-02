<?php 
if(isset($_SESSION["user"])) {
    header("location: index.php");
}

// si mes input du form en method POST sont différent d'un champ vide (donc plein)
if(!empty($_POST)) {
    if(isset($_POST["firstname"], $_POST["lastname"], $_POST["age"], $_POST["email"], $_POST["pass"], $_POST["confirmpassword"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["age"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirmpassword"]) ) {

        $_SESSION["error"] = [];
        $firstname = htmlentities($_POST["firstname"]);
        $lastname = htmlentities($_POST["lastname"]);
        $age = htmlentities($_POST["age"]);
        $age = (is_numeric($age)) ? (int)$age : 0;
        // prénom strictement inférieur à 2 caractères
        if(strlen($firstname) < 2) {
            $_SESSION["error"][] = "Le prénom est trop court";
        }
        // nom strictement inférieur à 2 caractères
        if(strlen($lastname) < 2) {
            $_SESSION["error"][] = "Le nom est trop court";
        }
        // âge compris entre 14 et 99 ans
        if($age < 14 || $age > 99) {
            $_SESSION["error"][] = "l'âge doit être compris entre 14 et 99 ans (compris)";
        }
        // mdp strictement inférieur à 8 caractères
        if(strlen($pass) < 8) {
            $_SESSION["error"][] = "Le mot de passe doit contenir 8 caractère minimum";
        }
        // mdp différent de confirm mdp
        if($_POST["pass"] !== $_POST["confirmpass"]) {
            $_SESSION["error"][] = "Les mots de passe saisi ne sont pas identique";
        }
        // filtre des emails rentré
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "L'adresse mail est incorrecte";
        }
        // si (aucune erreur) { alors let's go }
        if($_SESSION["error"] === []) {
            // hash du mot de passe avec les paramètres php par défaut et un délai de 12
            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT, ['cost' => 12]);
            // co à la bdd
            require_once "includes/connect.php";
            // email unique
            $email= strtolower($_POST["email"]);
            $sql = "SELECT * FROM `Member` WHERE email = ?";
            $query = $db->prepare($sql);
            $query->bindValue(1, $email, PDO::PARAM_STR);
            $query->execute();
            $verifmail = $query->fetch();
            if ($verifmail) {
                $_SESSION["error"] = ["L'email est déjà utilisé"];
            }
        }
        // le suite 
    }
}
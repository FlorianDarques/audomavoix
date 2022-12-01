<?php 
if(isset($_SESSION["user"])) {
    header("location: index.php");
}

// si mes input du form en method POST sont différent d'un champ vide (donc plein)
if(!empty($_POST)) {
    if(isset($_POST["name"], $_POST["surname"], $_POST["age"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]) && ) {

        $_SESSION["error"] = [];
        $name = htmlentities($_POST["name"]);
        $surname = htmlentities($_POST["surname"]);
        $age = htmlentities($_POST["age"]);
        $age = htmlentities(is_numeric($age));
        $email = htmlentities($_POST["email"]);
        $password = htmlentities($_POST["password"]);
        
    }
}
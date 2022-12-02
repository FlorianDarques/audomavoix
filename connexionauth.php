<?php
session_start();
// if (!isset($_SESSION["user"])) {
//     header("Location: connexion.php");
//     exit;
// }

$email = $_POST["email"];
$pass = $_POST["pass"];

if (!empty($_POST)) {
    if (isset($email, $pass) && !empty($email) && !empty($pass)) {
        $_SESSION["error"] = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "Adresse email ou mot de passe incorrect";
        }
        if ($_SESSION["error"] === []) {
            
            require "includes/connect.php";

            $sql = "SELECT * FROM `Member` WHERE `email` = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();

            if (!$user) {
                $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
            } else if ($pass != $user["pass"]) {
                $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
            }
            if ($_SESSION["error"] === [] && $user["admin"] != NULL) {
                $_SESSION["admin"] = true;
                header("Location: admin/index.php");
            } else if ($_SESSION["error"] === [] && $user["admin"] === NULL){
                header("Location: index.php");
            } else {
                header("Location: connexion.php");
            }
        }
    }
}
?>
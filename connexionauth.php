<?php
session_start();
// if (!isset($_SESSION["user"])) {
//     header("Location: connexion.php");
//     exit;
// }

$email = $_POST["email"];
$pass = $_POST["pass"];
$emailadmin = "admin@gmail.com";
$passadmin = "admin";

if (!empty($_POST)) {
    if (isset($email, $pass) && !empty($email) && !empty($pass)) {
        $_SESSION["error"] = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "Adresse email ou mot de passe incorrect";
        }
        if ($_SESSION["error"] === []) {

            if ($email === $emailadmin AND $pass === $passadmin) {
                $_SESSION["admin"] = true;
                header("Location: admin/index.php");
            }
            else {
            
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
            if ($_SESSION["error"] === []) {
                header("Location: index.php");
            }
        }
    }
}}
?>
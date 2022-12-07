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

            $sql = "SELECT * FROM `member` WHERE `email` = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();

            if (!$user) {
                
                // header("Location: connexion.php");
                $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";

            } else if (!password_verify($_POST["pass"], $user["pass"])) {
                
                // header("Location: connexion.php");
                $_SESSION["error"][] = "Utilisateur ou mot de passe incorrect";
                
            }
            if ($_SESSION["error"] === [] && $user["admin"] != NULL) {
                
                header("Location: admin/index.php");
                $_SESSION["admin"] = true;

            } if ($_SESSION["error"] === [] && $user["admin"] === NULL){

                header("Location: member.php");

            } 
        }
    }
}
?>

<?php 
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

    <div class="background_video">

        <video autoplay muted loop  src="video/bg.mp4"></video>

        <?php 
            require_once "includes/nav.php"; //---Inclus la navbar---//
        ?>

        <div class="connexion_box">

            <h1 class="h1_connexion">CONNEXION</h1>

            <form action="" method="POST" class="the-form">

                <div class="form_connexion_group">

                    <input type="email" class="form_connexion_field" placeholder="Adresse email" name="email" required>
                    <label for="email" class="form_connexion_label"> <i class="fa-regular fa-envelope"></i> Adresse email</label>

                </div>

                <div class="form_connexion_group">

                    <input type="password" class="form_connexion_field" placeholder="Mot de passe" name="pass" required>
                    <label for="pass" class="form_connexion_label"> <i class="fa-solid fa-lock"></i> Mot de passe</label>

                </div>

                <div class="btn_connexion">

                    <button type="submit" class="connexion_btn">
                    <i class="fa-sharp fa-solid fa-arrow-right icon_arrow"></i>
                    </button>

                </div>

            </form>

        </div>

<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
?>
    </div>

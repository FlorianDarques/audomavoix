<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "1"]){
    header("Location: wait.php");
    }
}  
if($_SESSION["user"]["age"] >= 18){
    header("Location: wait.php");
}

if(isset($_SESSION["user"])){
    $id = $_SESSION["user"]["id"];
    if($_SESSION["user"] > ["age => 18"]){
        require "includes/connect.php";
        $sql = "SELECT * FROM `representant` WHERE `IDmember` = '$id'";
                $query = $db->prepare($sql);
                $query->execute();
                $userUnder18 = $query->fetch();
        if(!empty($userUnder18)){
            header("Location: memberapi.php");
        }
        else{ 
            $nom = $_POST["rep-nom"];
            $prenom = $_POST["rep-prenom"];
            $_SESSION["error"] = [];
            if (strlen($nom) < 2) {
                $_SESSION["error"][] = "Le nom est trop court";
            }
            if (strlen($prenom) < 2) {
                $_SESSION["error"][] = "Le prénom est trop court";
            }
            if($_SESSION["error"] === []){
            $sql = "INSERT INTO `representant`(`IDmember`, `nom`, `prenom`) VALUES ('$id',:nom,:prenom)";
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $nom, PDO::PARAM_STR);
            $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
            $query->execute();
              
            if($_SESSION["error"] === []){
                header("Location: memberapi.php");
                }
            }
        }
    }
}
require_once "includes/header.php"; //---Inclus le header + ouvre le body---//

?>

<div class="background_video">

    <video autoplay muted loop src="video/bg.mp4"></video>


    <?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
    ?>
<div class="container-height">
<div class="repleg_box">

<h1 class="h1_repleg">Ajouter un représentant légal</h1>

<form action="" method="POST" class="the-form">

    <div class="form_repleg_group">

        <input type="text" class="form_connexion_field form_repleg_field" placeholder="Adresse email" name="rep-nom" required>
        <label for="rep-nom" class="form_connexion_label form_repleg_label"></i> Nom</label>

    </div>

    <div class="form_repleg_group">

        <input type="text" class="form_connexion_field form_repleg_field" placeholder="Mot de passe" name="rep-prenom" required>
        <label for="rep-prenom" class="form_connexion_label form_repleg_label"></i> Prénom</label>

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


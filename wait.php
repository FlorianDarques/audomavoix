<?php
session_start();
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "2"] || $_SESSION["stage"] != ["stage" => "4"]){
        if($_SESSION["stage"] == ["stage" => "1"]){
            header("Location: memberapi.php");
        }
        else if($_SESSION["stage"] == ["stage" => "3"]){
            header("Location: member.php");
        }
        else if($_SESSION["stage"] == ["stage" => "5"]){
            header("Location: paiement.php");
        }
        else if($_SESSION["stage"] == ["stage" => "6"]){
            header("Location: paiementrefus.php");
        }
        else if($_SESSION["stage"] == ["stage" => "7"]){
            header("Location: facture.php");
        }
    }
}  
?>
<?php 
    require_once "includes/header.php";
?>

    <div class="background_video">
    <video autoplay muted loop src="video/bg.mp4"></video>

<?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
?>
<div class="inscription_box">
    <h1 class="h1wait">En attente d'une validation de l'administration</h1>
    <i class="fa-solid fa-spinner"></i>
</div>
    <?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
?>
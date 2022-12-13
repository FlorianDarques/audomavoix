<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "7"]){
    header("Location: wait.php");
    }
}  
require_once "includes/header.php"; //---Inclus le header + ouvre le body---//

?>

<div class="background_video">

    <video autoplay muted loop src="video/bg.mp4"></video>

    <?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
    ?>
<div class="container-upload">
    <h1>Facture</h1>
</div>
<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
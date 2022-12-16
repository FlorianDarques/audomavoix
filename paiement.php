<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "5"]){
    header("Location: wait.php");
    }
}  

$id = $_SESSION["user"]["id"];
require_once"includes/connect.php";
$sql = "SELECT * FROM `Inscription` WHERE Inscription.IDuser = '$id'";
            $query = $db->prepare($sql);
            $query->execute();
            $userstage = $query->fetch();
            $_SESSION["stage"] = [
                "stage" => $userstage["stage"]
                ];
require_once "includes/header.php"; //---Inclus le header + ouvre le body---//

?>

<div class="background_video">

    <video autoplay muted loop src="video/bg.mp4"></video>

    <?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
    ?>
    <div class="container-height">
    <div class="container-upload container-paiement">
    <h1 class="h1-paiement">Paiement de participation</h1>
    <p>Le coût de participation au concours de chant est à hauteur de 5€. Il est possible de remettre le chèque 
en main propre aux locaux d’Audomavoix à l’accueil et de vous munir d’une pièce d’identité ou à envoyer 
à l’adresse suivante : 27 rue de jsépa 62500 Saint-Omer</p>
    <h1 class="h1-paiement">Exemple</h1>
    <div class="containero">
  <input type="checkbox" id="zoomCheck">
  <label class="labelzoom" for="zoomCheck">
  <img src="img/cheque.jpg" class="cheque" alt="" srcset="">
  </label>
</div>
</div>
<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
    </div>
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "6"]){
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
    <H1 style="color: #EB2F07; text-decoration: underline;">Votre paiement a été refusé</H1>
    <h1>Paiement de participation</h1>
    <p>Le coût de participation au concours de chant est à hauteur de 5€. Il est possible de remettre le chèque 
en main propre aux locaux d’Audomavoix à l’accueil et de vous munir d’une pièce d’identité ou à envoyer 
à l’adresse suivante : 27 rue de jsépa 62500 Saint-Omer</p>
    <h1>Exemple</h1>
    <img src="img/cheque.jpg" class="cheque" alt="" srcset="">
</div>
<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
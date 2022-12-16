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
$id = $_SESSION["user"]["id"];
if ($_SESSION["user"]["age"] < 18) {
    require_once"includes/connect.php";
    $sql = "SELECT * FROM `representant` WHERE `IDmember` = '$id'";
    $query = $db->prepare($sql);
    $query->execute();
    $userUnder18 = $query->fetch();

    $_SESSION["repleg"] = [
          $userUnder18["nom"],
          $userUnder18["prenom"]
    ];
}

require_once "includes/header.php"; //---Inclus le header + ouvre le body---//

?>

<div class="background_video">

    <video autoplay muted loop src="video/bg.mp4"></video>

    <?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
    ?>
<div class="container-height">
<div class="container-upload container-facture">
    <h1 class="h1-facture">Facture</h1>
    <a href="downloadfacture.php" class="">Télécharger le PDF de la facture</a>
</div>
<div class="container-upload container-felicitation">
    <h1 class="h1-facture">Félicitation</h1>
    <p>Vous participez bien à notre concours de chant.<br> <br>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tristique, massa nec lacinia sollicitudin, ipsum nisl suscipit libero, lacinia ultricies urna metus non quam. Nulla id elementum elit. Duis viverra suscipit velit, a convallis magna interdum ut. Fusce efficitur risus sem. Vestibulum sit amet felis egestas, laoreet tellus nec, tincidunt mauris. Praesent dictum eget nunc scelerisque varius. In non ligula ac odio tincidunt porttitor vitae non urna. Pellentesque facilisis semper sapien eu volutpat. Maecenas urna tellus, sodales sit amet urna nec, euismod egestas leo. Nam vehicula tortor nibh, et tempus elit gravida sit amet. Vivamus ut pharetra ex. Nullam malesuada vulputate justo sed varius. Maecenas in molestie nisl. Integer quis magna rutrum, venenatis sapien in, accumsan ligula. Phasellus vulputate augue risus, et finibus orci congue id. <br> <br>

Vestibulum eu mi risus. Nam a nulla quis tortor iaculis finibus. Praesent quis sodales magna. Sed pellentesque eu nunc egestas fermentum. Nullam a lectus a mauris eleifend sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras rutrum, metus quis euismod efficitur, quam erat sagittis metus, non semper elit felis eget tortor. Sed eu nibh nisl. Aenean et lorem sed leo vestibulum varius in in felis. Aliquam eleifend libero orci, sit amet tincidunt quam accumsan quis. Integer eu metus lectus. Nunc risus enim, aliquam ut eros et, auctor imperdiet turpis. Nunc tempus lectus et commodo hendrerit. Suspendisse tempus est tempus ipsum pellentesque venenatis.
    </p>

</div>
<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
</div>


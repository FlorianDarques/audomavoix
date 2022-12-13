<?php 
session_start ();
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

    <div class="background_video">

        <video autoplay muted loop  src="video/bg.mp4"></video>

        <?php 
            require_once "includes/nav.php"; //---Inclus la navbar---//
        ?>

        <div class="container-upload">

            <h1>Votre musique à bien été envoyé</h1>

            <p>En attente de validation, veuillez revenir ultérieurement</p>

        </div>

<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
?>
    </div>


    </div>
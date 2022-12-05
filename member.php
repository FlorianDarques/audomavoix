<?php 
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

    <div class="background_video">

        <video autoplay muted loop  src="video/bg.mp4"></video>

        <?php 
            require_once "includes/nav.php"; //---Inclus la navbar---//
        ?>

        <div>API</div>

        <div>

            <h1>Joignez votre enregistrement</h1>

            <form action="memberphp.php" method="post" enctype="multipart/form-data">

                <input type="file" name="file_mp3">
                <button type="submit">ENVOYER</button>

            </form>

        </div>


<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
?>
    </div>
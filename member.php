<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: connexion.php");
        exit;
    }
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

    <div class="background_video">

        <video autoplay muted loop  src="video/bg.mp4"></video>

        <?php 
            require_once "includes/nav.php"; //---Inclus la navbar---//
        ?>

        <div>API</div>
        <div class="container-upload">

            <h1>Joignez votre enregistrement</h1>

            <form action="memberphp.php" method="post" enctype="multipart/form-data" class="form-upload">
                <label class="labelmp3" for="fileInput"><i class="fa-solid fa-download"></i></label>
                <input type="file" id="fileInput" class="fileofmp3" name="file_mp3"></input>
                <?php
                    echo $_SESSION["user_message"];
                    $_SESSION["user_message"] = null; 
                ?>
                <button type="submit" class="button-upload">Valider</button>

            </form>

        </div>
        
<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
?>
    </div>


    </div>
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

            <form action="" method="post">

                <div class="form_connexion_group">

                    <input type="email" class="form_connexion_field" placeholder="Adresse email" name="email">
                    <label for="email" class="form_connexion_label"> <i class="fa-regular fa-envelope"></i> Adresse email</label>

                </div>

                <div class="form_connexion_group">

                    <input type="password" class="form_connexion_field" placeholder="Mot de passe" name="password">
                    <label for="password" class="form_connexion_label"> <i class="fa-solid fa-lock"></i> Mot de passe</label>

                </div>

                <div class="btn_connexion">

                    <button type="submit" class="connexion_btn">
                    <i class="fa-sharp fa-solid fa-arrow-right icon_arrow"></i>
                    </button>

                </div>

            </form>

        </div>

    </div>

<?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
?>
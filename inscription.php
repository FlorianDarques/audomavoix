<?php 
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

    <div class="background_video">

        <video autoplay muted loop  src="video/bg.mp4"></video>

        <?php 
            require_once "includes/nav.php"; //---Inclus la navbar---//
        ?>

        <div class="inscription_box">

            <h1 class="h1_inscription">INSCRIPTION</h1>

            <form action="inscriptionauth.php" method="post">

                <div class="form_inscription_group">

                    <input type="text" class="form_inscription_field" placeholder="Nom" name="name">
                    <label for="name" class="form_inscription_label"> <i class="fa-regular fa-user"></i> Nom</label>

                </div>

                <div class="form_inscription_group">

                    <input type="text" class="form_inscription_field" placeholder="Prénom" name="surname">
                    <label for="surname" class="form_inscription_label"> <i class="fa-regular fa-user"></i> Prénom</label>

                </div>

                <div class="form_inscription_group">

                    <input type="number" class="form_inscription_field" placeholder="Âge" name="age">
                    <label for="age" class="form_inscription_label"> <i class="fa-regular fa-user"></i> Âge</label>

                </div>

                <div class="form_inscription_group">

                    <input type="email" class="form_inscription_field" placeholder="Adresse email" name="email">
                    <label for="email" class="form_inscription_label"> <i class="fa-regular fa-envelope"></i> Adresse email</label>

                </div>

                <div class="form_inscription_group">

                    <input type="password" class="form_inscription_field" placeholder="Mot de passe" name="password">
                    <label for="password" class="form_inscription_label"> <i class="fa-solid fa-lock"></i> Mot de passe</label>

                </div>

                <div class="form_inscription_group">

                    <input type="password" class="form_inscription_field" placeholder="Confirmer mdp" name="confirmpassword">
                    <label for="confirmpassword" class="form_inscription_label"> <i class="fa-solid fa-lock"></i> Confirmer mdp</label>

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

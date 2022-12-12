<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: member.php");
    exit;
}
// si mes input du form en method POST sont différent d'un champ vide (donc plein)
if (!empty($_POST)) {
    if (isset($_POST["firstname"], $_POST["lastname"], $_POST["age"], $_POST["email"], $_POST["pass"], $_POST["confirmpass"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["age"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["confirmpass"])) {
        $_SESSION["error"] = [];
        $firstname = strip_tags($_POST["firstname"]);
        $lastname = strip_tags($_POST["lastname"]);
        $age = strip_tags($_POST["age"]);
        $age = (is_numeric($age)) ? (int)$age : 0;
        // prénom strictement inférieur à 2 caractères
        if (strlen($firstname) < 2) {
            $_SESSION["error"][] = "Le prénom est trop court";
        }
        // nom strictement inférieur à 2 caractères
        if (strlen($lastname) < 2) {
            $_SESSION["error"][] = "Le nom est trop court";
        }
        // âge compris entre 14 et 99 ans
        if ($age < 14 || $age > 99) {
            $_SESSION["error"][] = "l'âge doit être compris entre 14 et 99 ans (compris)";
        }
        // mdp strictement inférieur à 8 caractères
        if (strlen($_POST["pass"]) < 8) {
            $_SESSION["error"][] = "Le mot de passe doit contenir 8 caractère minimum";
        }
        // mdp différent de confirm mdp
        if ($_POST["pass"] !== $_POST["confirmpass"]) {
            $_SESSION["error"][] = "Les mots de passe saisi ne sont pas identique";
        }
        // filtre des emails rentré
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"][] = "L'adresse mail est incorrecte";
        }
        // si (aucune erreur) { alors let's go }
        if ($_SESSION["error"] === []) {
            // hash du mot de passe avec les paramètres php par défaut et un délai de 12
            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT, ['cost' => 12]);
            // co à la bdd
            require_once "includes/connect.php";
            // email unique
            $email = strtolower($_POST["email"]);
            $sql = "SELECT * FROM `Member` WHERE email = ?";
            $query = $db->prepare($sql);
            $query->bindValue(1, $email, PDO::PARAM_STR);
            $query->execute();
            $verifmail = $query->fetch();
            if ($verifmail) {
                $_SESSION["error"] = ["L'email est déjà utilisé"];
            }

            // la suite si pas d'erreur
            if ($_SESSION["error"] === []) {
                $sql = "INSERT INTO `Member`(`lastname`, `firstname`, `age`, `email`, `pass`) VALUES (:lastname,:firstname,:age,:email,'$pass')";
                $query = $db->prepare($sql);
                // on attribue dans la bdd les données des variables obtenus par la méthode "post"
                $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
                $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
                $query->bindValue(":age", $age, PDO::PARAM_STR);
                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->execute();
                // création d'une var ID où on lui attribue l'A_I ID de la dernière rangée. 
                $id = $db->lastInsertId();
                $_SESSION["user"] = [
                    "id" => $id,
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "age" => $age,
                    "email" => $email
                ];
                $sql2 = "INSERT INTO `Inscription`(`song`, `author`, `IDuser`, `stage`) VALUES ('none','none','$id','1')";
                $query2 = $db->prepare($sql2);
                $query2->execute();
                $sql = "SELECT * FROM `Member` , `Inscription` WHERE `email` = :email AND Member.id = Inscription.IDuser";
                $query = $db->prepare($sql);
                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->execute();
                $user = $query->fetch();
                $_SESSION["stage"] = [
                    "stage" => $user["stage"]
                ];

                // si tout est bon, l'utilisateur est redirigé vers la page
                // création d'une session validate
                $_SESSION["validate"] = [];
                if ($_SESSION["validate"] === []) {
                    $valid = 1;
                }
            }
        }
    } else {
        $_SESSION["error"] = ["Erreur"];
    }
}
?>

<?php
require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

<div class="background_video">
    <video autoplay muted loop src="video/bg.mp4"></video>

    <?php
    require_once "includes/nav.php"; //---Inclus la navbar---//
    ?>

    <?php
    if (isset($_SESSION["error"])) {
        foreach ($_SESSION["error"] as $message) {
    ?>
            <p><?= $message ?></p>
    <?php
        }
        unset($_SESSION["error"]);
    }
    ?>


    <div class="inscription_box">

        <h1 class="h1_inscription">INSCRIPTION</h1>

        <form action="" method="POST" class="the-form">

            <div class="form_inscription_group">

                <input type="text" class="form_inscription_field" placeholder="Nom" name="lastname" id="lastname" require>
                <label for="lastname" class="form_inscription_label"> <i class="fa-regular fa-user"></i> Nom</label>

            </div>

            <div class="form_inscription_group">

                <input id="firstname" type="text" class="form_inscription_field" placeholder="Prénom" name="firstname" require>
                <label for="firstname" class="form_inscription_label"> <i class="fa-regular fa-user"></i> Prénom</label>

            </div>

            <div class="form_inscription_group">

                <input type="number" id="age" class="form_inscription_field" placeholder="Âge" name="age" require>
                <label for="age" class="form_inscription_label"> <i class="fa-regular fa-user"></i> Âge</label>

            </div>

            <i class="fa-regular fa-circle-check"></i>

            <div class="form_inscription_group">

                <input type="email" id="email" class="form_inscription_field" placeholder="Adresse email" name="email" require>
                <label for="email" class="form_inscription_label"> <i class="fa-regular fa-envelope"></i> Adresse email</label>

            </div>

            <div class="form_inscription_group">

                <input type="password" class="form_inscription_field" placeholder="Mot de passe" name="pass" require>
                <label for="pass" class="form_inscription_label"> <i class="fa-solid fa-lock"></i> Mot de passe</label>

            </div>

            <div class="form_inscription_group">

                <input type="password" class="form_inscription_field" placeholder="Confirmer mdp" name="confirmpass" require>
                <label for="confirmpass" class="form_inscription_label"> <i class="fa-solid fa-lock"></i> Confirmer mdp</label>

            </div>

            <div class="btn_connexion">

                <button type="submit" class="connexion_btn">
                    <i class="fa-sharp fa-solid fa-arrow-right icon_arrow"></i>
                </button>

            </div>

        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
    <script type="text/javascript">
        // on récupère la var "valid" qui contient 1, elle prouve que l'inscription est validée
        var data = "<?php echo $valid; ?>";
        if (data == 1) {
            // on insère l'animation check ainsi que l'animation qui cache l'inscription box
            document.querySelector(".fa-circle-check").style.animation = "anim-check 0.5s linear forwards"
            document.querySelector(".inscription_box").style.animation = "anim-hidden-all 2s linear forwards"
            setInterval(exit, 2000)

            function exit() {
                // on redirige après 2s vers la page member
                // window.location.replace("http://5.135.101.252/audomavoix/memberapi.php")
                //    window.location.replace("http://localhost/audomavoix/memberapi.php");
            }
        }
        //on appelle des variables qui ciblent les inputs du form
        var lastName = document.getElementById("lastname")
        var firstName = document.getElementById("firstname")
        var age = document.getElementById("age")
        var email = document.getElementById("email")
        setInterval(getData, 2000)

        function getData() {
            // ici on stock les valeurs des inputs du form
            sessionStorage.setItem("dataLastName", lastName.value)
            sessionStorage.setItem("dataFirstName", firstName.value)
            sessionStorage.setItem("dataAge", age.value)
            sessionStorage.setItem("dataEmail", email.value)
        }
        // on attribue aux variables, donc aux inputs, les valeurs des stockages
        lastName.value = sessionStorage.getItem("dataLastName")
        firstName.value = sessionStorage.getItem("dataFirstName")
        age.value = sessionStorage.getItem("dataAge")
        email.value = sessionStorage.getItem("dataEmail")
    </script>
</div>
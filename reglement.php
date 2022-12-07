<?php 
    session_start();
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
    if(isset($_SESSION["user"])){
        $utilisateur = 1;
     }
    if(!isset($_SESSION["user"])){
        $utilisateur = 0;
    } 
?>

    <div class="background_video">

        <video autoplay muted loop  src="video/bg.mp4"></video>

        <?php 
            require_once "includes/nav.php"; //---Inclus la navbar---//
        ?>

        <div class="presentation_box">

            <h1 class="h1_title">INFORMATIONS</h1>

            <p class="p1 p">
            Editeur: Lorem ipsum
            <br>
            Siège social : 160, rue de Lalorem – 62001 Loremville
            <br>
            Capital social: 2 euros
            <br>
            RCS : 012 345 678
            <br>
            N° TVA : FR 99 888 777 666
            <br>
            N°CPPAP : 9876 W 12345
            <br>
            Gérant et Directeur de la publication: Aliquam euismod nibh arcu, elle-même représentée par Lucas BERTAUD, Florian DARQUES et Esteban PINHEIRO
            <br>
            Hébergeur: AENEAN FERMENTUM, rue Ipsum 987 D – 62002 Ipsumghem
            </p>

            <p class="p2 p">
                <h4>Préambule</h4>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam architecto minus cupiditate earum veritatis laudantium reiciendis nesciunt a ea. Magni esse officiis tempora nihil molestiae consectetur, eum sequi error expedita?
            Modi esse pariatur facilis inventore, est, nemo quos dolores tenetur voluptatem debitis sequi accusamus! Asperiores perspiciatis eius animi porro fuga voluptatem quis iusto error labore dignissimos, laborum impedit quam laudantium.
            Aut odio tenetur officia cum odit accusantium mollitia deleniti porro placeat fugit impedit non eligendi nisi suscipit obcaecati unde ducimus vitae, ab similique quos laborum labore pariatur saepe? Facilis, impedit?
            </p>

        </div>
        <script type="text/javascript">
            var data = "<?php echo $utilisateur; ?>";
            if(data == 1){
            document.querySelector('.fa-user').className = "fa-solid fa-power-off"
            document.querySelector('.nav-link').href = "deconnexion.php"
    }
            if(data == 0){
            //rien
    }
        </script>
    <?php
        require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
    </div>

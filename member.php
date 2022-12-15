<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: connexion.php");
        exit;
    }
    if(isset($_SESSION["stage"])){
        if($_SESSION["stage"] != ["stage" => "3"]){
        header("Location: wait.php");
        }
    }  
    if(isset($_SESSION["user"])){
      // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; 
        $id = $_SESSION["user"]["id"];
        require "includes/connect.php";
        $sql = "SELECT `song`, `author`, `IDuser` FROM `Inscription` WHERE IDuser = '$id'";
        $query = $db->prepare($sql);
        $query->execute();
        $donnees = $query->fetch();
        
        $req = "SELECT * FROM `files` WHERE `ID_member` = :id";
        $query = $db->prepare($req);
        $query->bindValue(":id", $_SESSION["user"]["id"], PDO::PARAM_STR);
        $query->execute();
        $data_music = $query->fetchAll();

        if (!empty($_FILES)){
            $file_name = $_FILES["file_mp3"]["name"];
            $file_extension = strrchr($file_name, ".");
            $file_tmp_name = $_FILES["file_mp3"]["tmp_name"];
            $file_dest = __DIR__.'/files/'.$file_name;
            $file_destbdd = '/files/'.$file_name;
            $file_error = $_FILES["file_mp3"]["error"];
            
           /* echo "Nom: ".$file_name. "</br>";
            echo "Extension: ".$file_extension. "</br>";
            echo "Erreur: ".$file_error. "</br>";
            echo "Destination: ".$file_dest. "</br>"; */
            
            $extention_accept = array('.mp3', '.MP3');
            if (in_array($file_extension, $extention_accept) && $file_error === 0){
    
                if (move_uploaded_file($file_tmp_name, $file_dest)){
    
                    
    
                    // $req = $db->prepare('INSERT INTO files(`name`, `file_url`, `ID_member`) VALUES(?,?,?)');
                    // $req->execute(array($file_name, $file_dest, $_SESSION["user"]["id"]));
    
                    $sql = ("UPDATE `files` SET `name`='$file_name',`file_url`='$file_destbdd' WHERE `ID_member` = '$id'");
                    $query = $db->prepare($sql);
                    $query->execute();
    
                    // $sql = "INSERT INTO `files`(`name`, `file_url`) VALUES (':name', ':file_url')";
                    // $query = $db->prepare($sql);
                    // $query->bindValue(":name", $file_name, PDO::PARAM_STR);
                    // $query->bindValue(":file_url", $file_dest, PDO::PARAM_STR);
                    // $query->execute();
    
                    $_SESSION["user_message"] = "Fichier envoyé avec succès !";
                    $sql = "UPDATE `Inscription` SET `stage`='4' WHERE IDuser = '$id'";
                    $query = $db->prepare($sql);
                    $query->execute();
                    $_SESSION["stage"] = [
                        "stage" => $donnees["stage"]
                    ];
                    header("Location: wait.php");
                    
                } 
                else {
    
                    $_SESSION["user_message"] = "Une erreur est survenue lors de l'envoie du fichier.";
                    
                }
            } else {
    
                $_SESSION["user_message"] = "Seul les fichiers mp3 sont autorisés.";
                
            }
        }
    
    }
    require_once "includes/header.php"; //---Inclus le header + ouvre le body---//
?>

<div class="background_video">

    <video autoplay muted loop src="video/bg.mp4"></video>

    <?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
    ?>
    <div class="container-height">
    <div class="container-upload">
    <h1 class="h1-member">Votre choix musical</h1>
    <p>Auteur:<?= " " ?><span style="text-decoration: underline"><?=$donnees["author"];?></span></p>
    <p>Chanson:<?=" "?><span style="text-decoration: underline"><?=$donnees["song"];?></span></p>
    </div>

    <div class="container-upload">

        <h1 class="h1-member">Joignez votre enregistrement</h1>

        <form action="" method="post" enctype="multipart/form-data" class="form-upload">
            <label class="labelmp3" for="fileInput"><i class="fa-solid fa-download"></i></label>
            <input type="file" id="fileInput" class="fileofmp3" name="file_mp3"></input>
            <?php
            echo $_SESSION["user_message"];
            $_SESSION["user_message"] = null;
            ?>
            <button type="submit" class="button-upload" value="Upload Audio" name="submit-mp3">Valider</button>

        </form>

    </div>
    <?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
</div>
</div>

</div>
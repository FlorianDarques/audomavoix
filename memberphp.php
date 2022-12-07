<?php
session_start();


    if (!empty($_FILES)){
        $file_name = $_FILES["file_mp3"]["name"];
        $file_extension = strrchr($file_name, ".");
        $file_tmp_name = $_FILES["file_mp3"]["tmp_name"];
        $file_dest = __DIR__.'/files/'.$file_name;
        $file_error = $_FILES["file_mp3"]["error"];

        echo "Nom: ".$file_name. "</br>";
        echo "Extension: ".$file_extension. "</br>";
        echo "Erreur: ".$file_error. "</br>";
        echo "Destination: ".$file_dest. "</br>";
        
        $extention_accept = array(".mp3", ".MP3");

        if (in_array($file_extension, $extention_accept) && $file_error === 0){

            if (move_uploaded_file($file_tmp_name, $file_dest)){

                require "includes/connect.php";

                $req = $db->prepare('INSERT INTO files(name, file_url) VALUES(?,?)');
                $req->execute(array($file_name, $file_dest));

                // $sql = "INSERT INTO `files`(`name`, `file_url`) VALUES (':name',':file_url')";
                // $query = $db->prepare($sql);
                // $query->bindValue(":name", $file_name, PDO::PARAM_STR);
                // $query->bindValue(":file_url", $file_dest, PDO::PARAM_STR);
                // $query->execute();

                $_SESSION["user_message"] = "Fichier envoyé avec succès !";
                header("Location: member.php");

            } else {
                $_SESSION["user_message"] = "Une erreur est survenue lors de l'envoie du fichier.";
                header("Location: member.php");
            }
        } else {

            $_SESSION["user_message"] = "Seul les fichiers mp3 sont autorisés.";
            header("Location: member.php");
            exit;
        }
    }

?>
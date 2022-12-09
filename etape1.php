<?php
session_start();
// mettre un id user et un stage
if(!isset($_SESSION["user"])){
header("Location: connexion.php");
}
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "1"]){
    header("Location: wait.php");
    }
}  
if(isset($_SESSION["user"])){
    echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; 
    $id = $_SESSION["user"]["id"];
if(isset($_POST['button'])){
    require "includes/connect.php";
    $sql = "UPDATE `Inscription` SET `stage`='2' WHERE IDuser = '$id'";
    $query = $db->prepare($sql);
    $query->execute();
    $_SESSION["stage"] = [
        "stage" => $donnees["stage"]
    ];
    header("Location: wait.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Etape 1</p>
    <form action="" method="post">
        <button type="submit" name='button'></button>
    </form>
    <a href="deconnexion.php">Deconnexion</a>
</body>
</html>
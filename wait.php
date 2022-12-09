<?php
session_start();
if(isset($_SESSION["stage"])){
    if($_SESSION["stage"] != ["stage" => "2"] || $_SESSION["stage"] != ["stage" => "4"] || $_SESSION["stage"] != ["stage" => "6"]){
        if($_SESSION["stage"] == ["stage" => "1"]){
            header("Location: etape1.php");
        }
        else if($_SESSION["stage"] == ["stage" => "3"]){
            header("Location: etape2.php");
        }
        else if($_SESSION["stage"] == ["stage" => "5"]){
            header("Location: etape3.php");
        }
        else if($_SESSION["stage"] == ["stage" => "7"]){
            header("Location: etape4.php");
        }
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
    <p>En attente d'une validation de l'administration</p>
    <a href="deconnexion.php">Deconnexion</a>
</body>
</html>
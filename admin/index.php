<?php
session_start();
//---SI LA SESSION ADMIN N'EST PAS TRUE, ALORS CA REDIRIGE VERS LA PAGE D'ACCEUIL---//
if (!$_SESSION["admin"]) {
    header("Location: ../index.php");
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
    
    <div class="btn_deconnexion">
        <a href="../deconnexion.php">DECONNEXION</a>
    </div>

</body>
</html>
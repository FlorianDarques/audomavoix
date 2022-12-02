<?php
session_start();
//---SI LA SESSION ADMIN N'EST PAS TRUE, ALORS CA REDIRIGE VERS LA PAGE D'ACCEUIL---//
if (!$_SESSION["admin"]) {
    header("Location: ../index.php");
}
?>
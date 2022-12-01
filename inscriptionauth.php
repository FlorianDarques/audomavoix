<?php 
if(isset($_SESSION["user"])) {
    header("location: index.php");
}

// si mes input du form en method POST sont différent d'un champ vide (donc plein)
if(!empty($_POST)) {
    
}
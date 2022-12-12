<?php
session_start();
//---SI LA SESSION ADMIN N'EST PAS TRUE, ALORS CA REDIRIGE VERS LA PAGE D'ACCEUIL---//
if (!$_SESSION["admin"]) {
    header("Location: ../index.php");
}
// Enlever la session pageuser
unset($_SESSION["pageuser"]);
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    
    <div class="container-buttons">
        <a href="../deconnexion.php"><i class="fa-solid fa-power-off"></i></a>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr class="table-dark">
                <th>Profil</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Email</th>
                <th>Auteur</th>
                <th>Chanson</th>
            </tr>
        </thead>
        <tbody>
        <?php     
        require "../includes/connect.php";
        // on récupère les données membres dans SQL 
        $sql = "SELECT * FROM `Member`, `Inscription` WHERE Member.id = Inscription.IDuser AND Member.admin IS NULL";
        $query = $db->prepare($sql);
        $query->execute();
        // on récupère toutes les lignes de chaque membres
        $donnees = $query->fetchAll();
        // on transforme toutes ces données pour devenir une donnée individuelle pour chaque membres
        foreach($donnees as $donnee => $valueuser): // on termine la boucle plus tard quand on aura distribué à chaque tables ses données utilisateurs 
        
        ?>
            <tr>
                    <th><a href="user.php?Id=<?php echo $valueuser["id"];
                    ?>"><i class="fa-solid fa-id-card-clip"></i></a></th>
                    <th><?php echo $valueuser["lastname"]?></th>
                    <th><?php echo $valueuser["firstname"]?></th>
                    <th><?php echo $valueuser["age"]?></th>
                    <th><?php echo $valueuser["email"]?></th>
                    <th><?php echo $valueuser["author"]?></th>
                    <th><?php echo $valueuser["song"]?></th>
                    
            </tr>
            <?php
        endforeach; // ici on termine la boucle
            ?>
        </tbody>
        <tfoot>
            <tr class="table-dark">
                <th>Profil</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Email</th>
                <th>Auteur</th>
                <th>Chanson</th>
            </tr>
        </tfoot>
    </table>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
   <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
   <script src="admin.js"></script>
</body>
</html>
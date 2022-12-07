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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <title>Document</title>
</head>
<body>
    
    <div class="btn_deconnexion">
        <a href="../deconnexion.php">DECONNEXION</a>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>                
            <tr>
                <td>1</td>
                <td>Bertaud</td>
                <td>Lucas</td>
                <td>23</td>
                <td>l.bertaud@hotmail.com</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Pelle</td>
                <td>Jérome</td>
                <td>35</td>
                <td>Jérome@gmail.com</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
        </tfoot>
    </table>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
   <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
   <script src="admin.js"></script>
</body>
</html>
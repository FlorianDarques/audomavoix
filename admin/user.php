<?php
session_start();
if (!$_SESSION["admin"]) {
    header("Location: ../index.php");
}
// l'echo permet de voir les $_SESSION
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; 
$IDpage = $_GET['Id']; // On récupère l'ID sur la barre HTML
require "../includes/connect.php";
$sql = "SELECT * FROM `Member`, `Inscription` WHERE Member.id = Inscription.IDuser AND Inscription.IDuser = '$IDpage'";
$query = $db->prepare($sql);
$query->execute();
$valueuser = $query->fetch();
$_SESSION["pageuser"]=[$valueuser["id"], $valueuser["lastname"], $valueuser["firstname"],$valueuser["age"],$valueuser["email"],$valueuser["author"],$valueuser["song"],$valueuser["stage"]];
$id = $_SESSION['pageuser']['0'];
$lastname = $_SESSION['pageuser']['1'];
$firstname = $_SESSION['pageuser']['2'];
$age = $_SESSION['pageuser']['3'];
$email = $_SESSION['pageuser']['4'];
$author = $_SESSION['pageuser']['5'];
$song = $_SESSION['pageuser']['6'];
$stage = $_SESSION['pageuser']['7'];


if(isset($_POST["optradiostage"]) && !empty($_POST["optradiostage"])){
$optionstage = $_POST["optradiostage"];
$sql = "UPDATE `Inscription` SET `stage`='$optionstage' WHERE `IDuser` = '$id'";
$query = $db->prepare($sql);
$query->execute();
    if($optionstage == 1){
        $sql = "DELETE FROM `files` WHERE ID_member = '$id'";
        $query = $db->prepare($sql);
        $query->execute();
    }
    header("Location: index.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="user.css">
    <title>Document</title>
</head>
<body>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="container-buttons">
        <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
        <a href="../deconnexion.php"><i class="fa-solid fa-power-off"></i></a>
    </div>
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo "$firstname $lastname" ?></span><span class="text-black-50"><?php echo "$email" ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Firstname</label><input type="text" class="form-control" placeholder="<?php echo "$firstname" ?>" value="" disabled></div>
                    <div class="col-md-6"><label class="labels">Lastname</label><input type="text" class="form-control" value="" placeholder="<?= "$lastname" ?>" disabled></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Âge</label><input type="text" class="form-control" placeholder="<?= "$age" ?>" disabled value=""></div>
                    <form action="" method="post">
                    <div class="col-md-12">
                        <label class="form-check-label" for="radio1">Étape 1</label><br>
                        <input type="radio" class="form-check-input" id="radio1" name="optradiostage" value="1" 
                        <?php 
                        if($stage !== 2){
                            echo "disabled";
                        }
                        if($stage == 2){
                            echo "checked";
                        }
                        ?>>Refuser
                        <input type="radio" class="form-check-input" id="radio2" name="optradiostage" value="3" 
                        <?php 
                        if($stage !== 2){
                            echo "disabled";
                        }
                        ?>>Accepter
                    </div>
                    <div class="col-md-12">
                    <label class="form-check-label" for="radio2">Étape 2</label><br>    
                    <input type="radio" class="form-check-input" id="radio1" name="optradiostage" value="3"
                    <?php 
                        if($stage !== 4){
                            echo "disabled";
                        }
                        if($stage == 4){
                            echo "checked";
                        }
                    ?>>Refuser
                    <input type="radio" class="form-check-input" id="radio2" name="optradiostage" value="5"
                    <?php 
                        if($stage !== 4){
                            echo "disabled";
                        }
                    ?>>Accepter
                    </div>
                    <div class="col-md-12">
                    <label class="form-check-label" for="radio3">Étape 3</label><br>    
                    <input type="radio" class="form-check-input" id="radio1" name="optradiostage" value="5"
                    <?php 
                        if($stage !== 6){
                            echo "disabled";
                        }
                        if($stage == 6){
                            echo "checked";
                        }
                    ?>>Refuser
                    <input type="radio" class="form-check-input" id="radio2" name="optradiostage" value="7"
                    <?php 
                        if($stage !== 6){
                            echo "disabled";
                        }
                    ?>>Accepter
                    </div>
                </div>
                <?php 
                if($stage == 1 || $stage == 3 || $stage == 5 || $stage == 7){
                echo'<div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Étape actuelle</label><input type="text" class="form-control"';
                    if($stage == 1){
                        $stage = "Choisir sa chanson";
                    }
                    if($stage == 3){
                        $stage = "Envoyer sa chanson";
                    }
                    if($stage == 5){
                        $stage = "Procéder au paiement";
                    }
                    if($stage == 7){
                        $stage = "Terminer";
                    }
                    echo "placeholder=' $stage ' value='' disabled></div>
                </div>";
            }
                ?>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Valider</button></div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Choix Musical</span></i></span></div><br>
                <div class="col-md-12"><label class="labels">Auteur</label><input type="text" class="form-control" placeholder="<?= $author ?>" value="" disabled></div> <br>
                <div class="col-md-12"><label class="labels">Chanson</label><input type="text" class="form-control" placeholder="<?= $song?>" value="" disabled></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script> 
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
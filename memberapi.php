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
} // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; 
    $id = $_SESSION["user"]["id"];

    if($_SESSION["user"]["age"] < 18){
        // verification de l'âge si en dessous de 18 ans et qu'aucune donnée n'a été récupéré, alors on va renvoyer le mineur vers la page replegal.php 
        require_once "includes/connect.php";
        $sql = "SELECT * FROM `representant` WHERE `IDmember` = '$id'";
                $query = $db->prepare($sql);
                $query->execute();
                $userUnder18 = $query->fetch();
        if(empty($userUnder18)){
            header("Location: replegal.php");
        }
    }

      
    
$curl = curl_init();
$name_music = str_replace(" ", "%20", $_GET["music"]);
$url = "https://shazam.p.rapidapi.com/search?term=".$name_music."&locale=en-US&offset=0&limit=5";


curl_setopt_array($curl, [
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: shazam.p.rapidapi.com",
		"X-RapidAPI-Key: a686ab8425msh2443fc485de7c08p17cbe9jsnd64a4599be94"

	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$resultat= json_decode($response, true);

if ($err) {
	echo "cURL Error #:" . $err;
} 

        
   
    ?>


<?php 
    require_once "includes/header.php";
?>

    <div class="background_video">
    <video autoplay muted loop src="video/bg.mp4"></video>

<?php
    require_once "includes/nav2.php"; //---Inclus la navbar---//
?>

<div class="container-height">
<div class="memberapi_box">
    <h1 class="h1_memberapi">Sélection du titre</h1>
    <form action="" method="get" class="the-form-api">
        <div class="form-div-memberapi form_api_group">
        <input type="text" class="form-memberapi" name="music" id="" placeholder="Rechercher">

        <button type="submit" class="button-memberapi"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>

<form action="" method="post" class="the-form-api">
    <div class="form-div-memberapi2">
        <select name="choise_music" class="form_memberapi_field" id="">

    <?php 
    
    for ($i=0; $i < 4; $i++) {
        
        $title = $resultat["tracks"]["hits"][$i]["track"]["title"];
        $artist = $resultat["tracks"]["hits"][$i]["track"]["subtitle"];
        $key = $resultat["tracks"]["hits"][$i]["track"]["key"];

        if (!empty($title)) {
    ?>

            <option value="<?php echo $key . "☯" . $title . "☯" . $artist; ?>"><?php echo $title." par ".$artist; ?></option>
        
    <?php
    }
    }
    if (!empty($_POST)) {
        $list = explode('☯', $_POST["choise_music"]); // nous permet de séparer chaque value du post choise music, ces données sont séparées par '☯'
        require_once "includes/connect.php";
            $query = $db->prepare("INSERT INTO `files`(`key_music`, `ID_member`) VALUES(:key_music, :id)");
            $query->bindValue(':key_music', $list[0], PDO::PARAM_STR);
            $query->bindValue(':id', $_SESSION["user"]["id"], PDO::PARAM_STR);
            $query->execute();

            $_SESSION["erreur"] = [];
            if($_SESSION["erreur"] == []){
                require_once "includes/connect.php";
            $sql = "UPDATE `Inscription` SET `stage`='2' , `author`='$list[2]' , `song`='$list[1]' WHERE IDuser = '$id'";
            $query = $db->prepare($sql);
            $query->execute();
            $_SESSION["erreur"] = ["R"];
            if($_SESSION["erreur"] == ["R"]){
                require_once "includes/connect.php";
                $sql = "SELECT * FROM `Member` , `Inscription` WHERE `email` = :email AND Member.id = Inscription.IDuser";
                $query = $db->prepare($sql);
                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->execute();
                $user = $query->fetch();
                $_SESSION["erreur"] = ["RR"];
                if($_SESSION["erreur"] == ["RR"]){
                    $_SESSION["stage"] = [
                        "stage" => $user["stage"]
                        ];
                    header("Location: wait.php"); 
                }
        }
            }
        } else {
    
            $_SESSION["user_message"] = "Veuillez sélectionner une musique.";
    
        }
        
    ?>

        </select>
        
        <button type="submit" class="button-memberapi-validate" >Valider</button>
        
    </div>
        
</form>
    </div>
    <?php
    require_once "includes/footer.php"; //---Inclus le footer + ferme le body et html---//
    ?>
    </div>
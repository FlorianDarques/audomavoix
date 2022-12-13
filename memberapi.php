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
   // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; 
    $id = $_SESSION["user"]["id"];
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
    require_once "includes/nav.php"; //---Inclus la navbar---//
?>

    <form action="" method="get">

        <input type="text" name="music" id="">

        <button type="submit">Rechercher</button>

    </form>

<form action="" method="post">

        <select name="choise_music" id="">

    <?php 
    
    for ($i=0; $i < 4; $i++) {
        
        $title = $resultat["tracks"]["hits"][$i]["track"]["title"];
        $artist = $resultat["tracks"]["hits"][$i]["track"]["subtitle"];
        $key = $resultat["tracks"]["hits"][$i]["track"]["key"];

        if (!empty($title)) {
    ?>

            <option value="<?php echo $key . "-" . $title . "-" . $artist; ?>"><?php echo $title." par ".$artist; ?></option>
        
    <?php
    }
    }
    if (!empty($_POST)) {
        $list = explode('-', $_POST["choise_music"]);
        require "includes/connect.php";
            
            $query = $db->prepare("INSERT INTO `files`(`key_music`, `ID_member`) VALUES(:key_music, :id)");
            $query->bindValue(':key_music', $list[0], PDO::PARAM_STR);
            $query->bindValue(':id', $_SESSION["user"]["id"], PDO::PARAM_STR);
            $query->execute();

            $_SESSION["erreur"] = [];
            if($_SESSION["erreur"] == []){
            $sql = "UPDATE `Inscription` SET `stage`='2' , `author`='$list[2]' , `song`='$list[1]' WHERE IDuser = '$id'";
            $query = $db->prepare($sql);
            $query->execute();
            $_SESSION["erreur"] = ["R"];
            if($_SESSION["erreur"] == ["R"]){
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

        <button type="submit">Valider</button>

</form>
</body>
</html>
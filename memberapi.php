<?php
session_start();


$curl = curl_init();
$name_music = str_replace(" ", "%20", $_GET["music"]);

curl_setopt_array($curl, [
	CURLOPT_URL => "https://shazam.p.rapidapi.com/search?term=".$name_music."&locale=en-US&offset=0&limit=5",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: shazam.p.rapidapi.com",
		"X-RapidAPI-Key: 0ad0c979ffmshc1647053033bcb0p1a0071jsn1dcd5dfe27ce"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$resultat= json_decode($response, true);

if ($err) {
	echo "cURL Error #:" . $err;
} 



    if (!empty($_POST)) {

    require "includes/connect.php";

        $query = $db->prepare("INSERT INTO `files`(`key_music`, `ID_member`) VALUES(:key_music, :id)");
        $query->bindValue(':key_music', $_POST["choise_music"], PDO::PARAM_STR);
        $query->bindValue(':id', $_SESSION["user"]["id"], PDO::PARAM_STR);
        $query->execute();

        
        header("Location: member.php");

    } else {

        $_SESSION["user_message"] = "Veuillez sélectionner une musique.";

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test api</title>
</head>
<body>

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

            <option value="<?php echo $key; ?>"><?php echo $title." par ".$artist; ?></option>
        
    <?php
    }
    }

    ?>

        </select>


        <button type="submit">Valider</button>

    </form>
</body>
</html>
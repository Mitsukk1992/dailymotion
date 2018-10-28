<?php

// on inclus les headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// on inclus l'entité et la base
include_once '../config/Database.php';
include_once '../objects/Video.php';
 
// on instancie la bdd et produit
$database = new Database();
$db = $database->getConnection();
 
// initialisation de l'objet videos
$videos = new Video($db);

// requete products
$stmt = $videos->showVideos();
$num = $stmt->rowCount();
 
// on check si il y a plus de 0 enregistrement
if ($num > 0) {
 
    // tabelau de vidéos
    $videos_arr = array();
    $videos_arr["videos"] = array();
 
    // récupère le contenu de la table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $videos_item = array(
            "id" => $id,
            "name" => $name,
            "thumbnail" => $thumbnail,
            "description" => html_entity_decode($description),
            "posted" => date($posted),
            "pseudo" => $pseudo
        );
 
        array_push($videos_arr["videos"], $videos_item);
    }

    http_response_code(200);
    print_r(json_encode($videos_arr));
} else {
    
    http_response_code(404);
    print_r(json_encode(array("message" => "No videos found.")));
}

?>

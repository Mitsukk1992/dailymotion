<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../objects/Playlist.php';

$database = new Database();
$db = $database->getConnection();

$playlist = new Playlist($db);

$playlist->id = isset($_GET['id']) ? $_GET['id'] : die();

$playlist->readOnePlaylist();
 
if ($playlist->name!=null) {

    $playlists_arr = array(
        "id" =>  $playlist->id,
        "name" => $playlist->name,
        "created" => $playlist->created
    );
    http_response_code(200);
    echo json_encode($playlists_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Playlist does not exist."));
}

?>

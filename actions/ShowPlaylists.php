<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../objects/Playlist.php';

$database = new Database();
$db = $database->getConnection();

$playlists = new Playlist($db);

$stmt = $playlists->showPlaylists();
$num = $stmt->rowCount();

if ($num > 0) {

    $playlists_arr = array();
    $playlists_arr["playlists"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $playlists_item = array(
            "id" => $id,
            "name" => $name,
            "created" => date($created)
        );
 
        array_push($playlists_arr["playlists"], $playlists_item);
    }

    http_response_code(200);
    print_r(json_encode($playlists_arr));
} else {

    http_response_code(404);
    print_r(json_encode(array("message" => "No playlists found.")));
}

?>

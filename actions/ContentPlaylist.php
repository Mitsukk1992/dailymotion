<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../objects/Relations.php';

$database = new Database();
$db = $database->getConnection();

$relations = new Relations($db);

$stmt = $relations->showVideosOnPlaylist();
$relations_arr = array();

if ($stmt->rowCount() > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($relations_arr, "Playlist name : " . $row['playlist_name']);
        array_push($relations_arr, "Playlist creation date : " . $row['created']);
        array_push($relations_arr, json_decode($row['videos']));
    }

    http_response_code(200);
    print_r(json_encode($relations_arr));

} else {

    http_response_code(404);
    print_r(json_encode(array("message" => "No playlists content found.")));
}

?>
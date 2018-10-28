<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../objects/Playlist.php';
 
$database = new Database();
$db = $database->getConnection();
 
$playlist = new Playlist($db);

$data = json_decode(file_get_contents("php://input"));

$playlist->id = $data->id;
 
if ($playlist->deletePlaylist()) {
    http_response_code(200);
    print_r(json_encode(array("message" => "Playlist was deleted.")));
} else {
    http_response_code(503);
    print_r(json_encode(array("message" => "Unable to delete playlist.")));
}

?>

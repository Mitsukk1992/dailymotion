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

// utilisation du php://input pour les requêtes POST
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->created)) {
    
    $playlist->name = $data->name;
    $playlist->created = $data->created;

    if ($playlist->CreatePlaylist() && validateDate($data->created)) {
        http_response_code(201);
        print_r(json_encode(array("message" => "Playlists was created.")));
    } else {
        http_response_code(503);
        print_r(json_encode(array("message" => "Unable to create playlists, check format of the date if is correct (the date must be in Y-m-d H:i).")));
    }

} else {
    http_response_code(400);
    print_r(json_encode(array("message" => "Unable to create playlists. Data is incomplete or invalide.")));
}

function validateDate($date, $format = 'Y-m-d H:i')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>

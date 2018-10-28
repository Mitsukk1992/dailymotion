<?php

class Playlist
{
    private $conn;
    private $table_name = "playlists";
 
    public $id;
    public $name;
    public $created;

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    // afficher les playlists
    function showPlaylists()
    {
        $query = "  SELECT p.id, p.name, p.created
                    FROM " . $this->table_name . " p
                    ORDER BY p.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
     
        return $stmt;
    }

    // créer une playlist
    function CreatePlaylist()
    {
        $query = "  INSERT INTO " . $this->table_name . " 
                    SET name=:name, created=:created";

        foreach ($this->showPlaylists() as $data) {
            $tab[] = $data['name'];
        }

        $stmt = $this->conn->prepare($query);

        if (in_array($this->name, $tab)) {
            print_r(json_encode(array("message" => "The name of the playlist already exists, chosen in another.")));
            exit();
        }

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->created = htmlspecialchars(strip_tags($this->created));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":created", $this->created);

        return $stmt->execute();
    }

    // affiche une playlist
    function readOnePlaylist()
    {
        $query = "  SELECT p.id, p.name, p.created
                    FROM " . $this->table_name . " p
                    WHERE p.id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->created = $row['created'];
    }

    function updatePlaylist()
    {
        $query = "  UPDATE " . $this->table_name . "
                    SET name = :name, created = :created
                    WHERE id = :id";

        foreach ($this->showPlaylists() as $data) {
            $tab[] = $data['id'];
        }

        if (!in_array($this->id, $tab)) {
            print_r(json_encode(array("message" => "The id of this playlist does not exist.")));
            exit();
        }
     
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':created', $this->created);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    function deletePlaylist() {

        $query = "  DELETE r.*,p.*
                    FROM playlists AS p
                    LEFT JOIN relations AS r ON r.id_playlist = p.id
                    WHERE id = ?;";

        foreach ($this->showPlaylists() as $data) {
            $tab[] = $data['id'];
        }

        if (!in_array($this->id, $tab)) {
            print_r(json_encode(array("message" => "The id of this playlist does not exist.")));
            exit();
        }

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }
}
<?php

class Video
{
    private $conn;
    private $table_name = "videos";
 
    public $id;
    public $name;
    public $thumbnail;
    public $description;
    public $posted;
    public $pseudo;

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    function showVideos()
    {
        $query = "  SELECT v.id, v.name, v.thumbnail, v.description, v.posted, v.pseudo
                    FROM " . $this->table_name . " v
                    ORDER BY v.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
     
        return $stmt;
    }
}
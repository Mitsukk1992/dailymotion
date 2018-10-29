<?php

class Relations
{
    private $conn;

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    function showVideosOnPlaylist()
    {
        $query = "  SELECT p.name as playlist_name, p.created as playlist_created, v.id as video_id, v.name as video_name, v.thumbnail, v.description, v.posted, v.pseudo
                    FROM relations as r
                    INNER JOIN playlists as p ON r.id_playlist = p.id
                    INNER JOIN videos as v ON r.id_video = v.id
                    ORDER BY v.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

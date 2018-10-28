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
        $query = "SELECT p.name as playlist_name, p.created,
                JSON_ARRAYAGG(
                    json_object
                    (
                        'video_name', v.name,
                        'thumbnail', v.thumbnail,
                        'description', v.description,
                        'posted', v.posted,
                        'pseudo', v.pseudo
                    )
                ) as videos
                FROM relations as r
                INNER JOIN playlists as p ON r.id_playlist = p.id
                LEFT JOIN videos as v ON r.id_video = v.id
                GROUP BY p.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

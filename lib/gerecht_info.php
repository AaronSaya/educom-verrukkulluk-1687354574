<?php

class gerechtInfo {

    private $connection;
    private $gebruiker;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->gebruiker = new Gebruiker($connection);
    }

    private function getGebruiker($gebruiker_id){
        return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
    }

    public function selecteerGerechtInfo($gerecht_id) {

        $sql = "select * from gerecht_info where gerecht_id = $gerecht_id";
        $result = mysqli_query($this->connection, $sql);
        //$gerecht_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $return = [];

        while ($gerecht_info = mysqli_fetch_array($result)) {
            $gebruiker = $this->getGebruiker($gerecht_info['gebruiker_id'], MYSQLI_ASSOC);

            if ($gerecht_info['record_type'] == "B") {
                
                $bereidingswijze = $gerecht_info['tekstveld'];
                
            $return[] = [
                "record_type" => $gerecht_info['record_type'],
                "datum" => $gerecht_info['datum'],
                "numeriekveld " => $gerecht_info['numeriekveld'],
                "tekstveld " => $gerecht_info['tekstveld'],
            ];
        } elseif ($gerecht_info['record_type'] == "O") {
            $opmerking = $gerecht_info['tekstveld'];

            $return[] = [
                "record_type" => $gerecht_info['record_type'],
                "datum" => $gerecht_info['datum'],
                "opmerking" => $opmerking,
                "gebruiker" => $gebruiker
            ];
        } elseif ($gerecht_info['record_type'] == "F") {
            $opmerking = $gerecht_info['tekstveld'];

            $return[] = [
                "record_type" => $gerecht_info['record_type'],
                "datum" => $gerecht_info['datum'],
                "gerecht_id" => $gerecht_info['gerecht_id'],
                "gebruiker_id" => $gerecht_info['gebruiker_id'],
                "gebruiker" => $gebruiker
            ];
        }
        elseif ($gerecht_info['record_type'] == "W") {
            $opmerking = $gerecht_info['tekstveld'];

            $return[] = [
                "record_type" => $gerecht_info['record_type'],
                "gerecht_id" => $gerecht_info['gerecht_id'],
                "gebruiker_id" => $gerecht_info['gebruiker_id'],
                "datum" => $gerecht_info['datum'],
                "numeriekveld " => $gerecht_info['numeriekveld'],
            ];
        }
        }
        return $return;

    }
}

?>
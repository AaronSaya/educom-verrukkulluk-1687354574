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


    public function addFavorite($gebruiker_id, $gerecht_id) {
        $sql = "INSERT INTO favorieten (gebruiker_id, gerecht_id) VALUES ($gebruiker_id, $gerecht_id)";
        mysqli_query($this->connection, $sql);
    }
    public function removeFavorite($gebruiker_id, $gerecht_id) {
        $sql = "DELETE FROM favorieten WHERE gebruiker_id = $gebruiker_id AND gerecht_id = $gerecht_id";
        mysqli_query($this->connection, $sql);
    }



    public function selecteerGerechtInfo($gerecht_id) {

        $sql = "select * from gerecht_info where gerecht_id = $gerecht_id";
        $result = mysqli_query($this->connection, $sql);
        
        $return=[];

        while ($gerecht_info = mysqli_fetch_array($result)) {
            
            $gebruiker = $this->getGebruiker($gerecht_info['gebruiker_id'], MYSQLI_ASSOC);

            

            if ($gerecht_info['record_type'] == "O" or $gerecht_info['record_type'] == "F") {
               
                $return [] = [
                    "id" => $gerecht_info["id"],
                    "record_type" => $gerecht_info["record_type"],
                    "gerecht_id" => $gerecht_info["gerecht_id"],
                    "opmerkingen" => $gerecht_info["tekstveld"],
                    "id" => $gebruiker["gebuiker_id"],
                    "gebruikersnaam" => $gebruiker["gebruikersnaam"],
                    "wachtwoord" => $gebruiker["wachtwoord"],
                    "email" => $gebruiker["email"],
                    "afbeelding" => $gebruiker["afbeelding"],

                ];
                    } 
             else {
                $return [] = [
                    "id" => $gerecht_info["id"],
                    "record_type" => $gerecht_info["record_type"],
                    "gerecht_id" => $gerecht_info["gerecht_id"],
                    "datum" => $gerecht_info["datum"],
                    "bereidingswijze" => $gerecht_info["tekstveld"],
                    "waardereing" => $gerecht_info["numeriekveld"],
                ];   
                      }
            }
            return ($return);
    }
}

?>
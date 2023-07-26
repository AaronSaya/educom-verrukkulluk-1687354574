<?php

class gerechtInfo
{

    private $connection;
    private $gebruiker;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->gebruiker = new Gebruiker($connection);
    }

    private function getGebruiker($gebruiker_id)
    {
        return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
    }


    public function getGerechtInfo($gerechtInfo_id)
    {
        $sql = "select * from `recipeInfo` where id = $gerechtInfo_id;";

        $result = mysqli_query($this->connection, $sql);
        $gerechtInfo = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return ($gerechtInfo);
    }

    public function addFavorite($gebruiker_id, $gerecht_id)
    {
        $sql = "INSERT INTO favorieten (gebruiker_id, gerecht_id) VALUES ($gebruiker_id, $gerecht_id)";
        mysqli_query($this->connection, $sql);
    }
    public function removeFavorite($gebruiker_id, $gerecht_id)
    {
        $sql = "DELETE FROM favorieten WHERE gebruiker_id = $gebruiker_id AND gerecht_id = $gerecht_id";
        mysqli_query($this->connection, $sql);
    }



    public function selecteerGerechtInfo($gerecht_id, $recordType)
    {

        $sql = "select * from gerecht_info where gerecht_id = $gerecht_id and record_type = '$recordType'";
        $result = mysqli_query($this->connection, $sql);

        $return = [];

        while ($gerechtInfo = mysqli_fetch_array($result)) {

            $gebruiker = $this->getGebruiker($gerechtInfo['gebruiker_id'], MYSQLI_ASSOC);



            if ($gerechtInfo['record_type'] == "O" or $gerechtInfo['record_type'] == "F") {

                $return[] = [
                    "id" => $gerechtInfo["id"],
                    "record_type" => $gerechtInfo["record_type"],
                    "gerecht_id" => $gerechtInfo["gerecht_id"],
                    "opmerkingen" => $gerechtInfo["tekstveld"],
                    "datum" => $gerechtInfo["datum"],
                    "gebruikerId" => $gebruiker["id"],
                    "gebruikersnaam" => $gebruiker["gebruikersnaam"],
                    "wachtwoord" => $gebruiker["wachtwoord"],
                    "email" => $gebruiker["email"],
                    "foto_gebruiker" => $gebruiker["foto_gebruiker"],

                ];
            } else {
                $return[] = [
                    "id" => $gerechtInfo["id"],
                    "record_type" => $gerechtInfo["record_type"],
                    "gerecht_id" => $gerechtInfo["gerecht_id"],
                    "datum" => $gerechtInfo["datum"],
                    "tekstveld" => $gerechtInfo["tekstveld"],
                    "numeriekveld" => $gerechtInfo["numeriekveld"],
                ];
            }

        }

        return ($return);
    }
}

?>
<?php

define("GERECHT_INFO_TYPE_BEREIDING", 'B');
define("GERECHT_INFO_TYPE_OPMERKING", 'O');
define("GERECHT_INFO_TYPE_FAVORIET", 'F');
define("GERECHT_INFO_TYPE_WAARDERING", 'W');
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

    public function bepaalFavoriet($gerecht_id, $gebruiker_id)
    {

        $record_type = GERECHT_INFO_TYPE_FAVORIET;
        $favorieten = ($this->selecteerGerechtInfo($record_type, $gerecht_id));
        foreach ($favorieten as $favoriet) {
            if ($favoriet['gerecht_id'] == $gerecht_id && $favoriet['gebruiker_id'] == $gebruiker_id) {
                return true;
            }
        }
        return false;
    }

    public function updateFavoriet($gerecht_id, $gebruiker_id)
    {

        $record_type = GERECHT_INFO_TYPE_FAVORIET;
        $currentDateTime = date('Y-m-d');

        $sql = "UPDATE gerecht_info SET `record_type`= `$record_type`, `gerecht_id` = `$gerecht_id`, `gebruiker_id` = `$gebruiker_id`, `datum` = `$currentDateTime`')";

        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function addFavoriet($gerecht_id, $gebruiker_id)
    {
        $record_type = GERECHT_INFO_TYPE_FAVORIET;
        $currentDateTime = date('Y-m-d');

        $sql = "INSERT INTO gerecht_info (record_type, gerecht_id, gebruiker_id, datum) VALUES ('$record_type', '$gerecht_id' , '$gebruiker_id', '$currentDateTime')";

        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function verwijderFavoriet($gebruiker_id, $gerecht_id)
    {
        $record_type = GERECHT_INFO_TYPE_FAVORIET;

        $sql = "DELETE FROM gerecht_info WHERE record_type = $record_type AND gebruiker_id = $gebruiker_id AND gerecht_id = $gerecht_id";
        mysqli_query($this->connection, $sql);
    }

    public function addRating($gerecht_id, $numeriekveld)
    {
        $record_type = GERECHT_INFO_TYPE_WAARDERING;
        $sql = "INSERT INTO gerecht_info (record_type, gerecht_id, numeriekveld) VALUES ('$record_type', '$gerecht_id', '$numeriekveld')";

        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function selecteerGerechtInfo($gerecht_id, $recordType)
    {

        $sql = "select * from gerecht_info where gerecht_id = $gerecht_id and record_type = '$recordType'";
        $result = mysqli_query($this->connection, $sql);

        $return = [];

        while ($gerechtInfo = mysqli_fetch_array($result)) {

            $gebruiker = $this->getGebruiker($gerechtInfo['gebruiker_id'], MYSQLI_ASSOC);



            if ($gerechtInfo['record_type'] == GERECHT_INFO_TYPE_OPMERKING || $gerechtInfo['record_type'] == GERECHT_INFO_TYPE_FAVORIET) {

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
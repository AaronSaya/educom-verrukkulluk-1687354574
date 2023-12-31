<?php


class ingrediënt
{

    private $connection;
    private $artikel;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->artikel = new Artikel($connection);
    }

    private function getArtikel($artikel_id)
    {
        return ($this->artikel->selecteerArtikel($artikel_id));
    }

    public function selecteerIngrediënt($gerecht_id)
    {

        $gerecht_id = mysqli_real_escape_string($this->connection, $gerecht_id);

        $sql = "select * FROM ingrediënten WHERE gerecht_id = $gerecht_id";
        $result = mysqli_query($this->connection, $sql);

        $return = [];

        while ($ingredienten = mysqli_fetch_array($result)) {



            $artikel = $this->getArtikel($ingredienten['artikel_id'], MYSQLI_ASSOC);

            $return[] = [
                "id" => $ingredienten['id'],
                "gerecht_id" => $ingredienten['gerecht_id'],
                "artikel_id" => $ingredienten['artikel_id'],
                "hoeveelheid" => $ingredienten['hoeveelheid'],
                "naam_artikel" => $artikel['naam_artikel'],
                "omschrijving" => $artikel["omschrijving"],
                "prijs" => $artikel["prijs"],
                "eenheid" => $artikel["eenheid"],
                "hoeveelheid_verpakking" => $artikel["hoeveelheid_verpakking"],
                "calorie" => $artikel["calorie"],
                "artikel_afbeelding" => $artikel["artikel_afbeelding"],

            ];



        }


        return $return;
    }
}




?>
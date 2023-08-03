<?php

class Boodschappen
{
    private $connection;
    private $ingrediënten;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->ingrediënten = new Ingrediënt($connection);
    }

    private function getIngrediënt($gerecht_id)
    {
        $gerecht_id = mysqli_real_escape_string($this->connection, $gerecht_id);
        return $this->ingrediënten->selecteerIngrediënt($gerecht_id);
    }

    public function selecteerBoodschappen($gebruiker_id)
    {
        $gebruiker_id = mysqli_real_escape_string($this->connection, $gebruiker_id);
        $sql = "SELECT * FROM boodschappenlijst WHERE gebruiker_id = '$gebruiker_id'";
        $result = mysqli_query($this->connection, $sql);
        $boodschappen = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $boodschappen[] = $row;
        }

        return $boodschappen;
    }

    public function artikelOpLijst($artikel_id, $gebruiker_id)
    {
        $artikel_id = mysqli_real_escape_string($this->connection, $artikel_id);
        $gebruiker_id = mysqli_real_escape_string($this->connection, $gebruiker_id);

        $sql = "SELECT * FROM boodschappenlijst WHERE gebruiker_id = '$gebruiker_id' AND artikel_id = '$artikel_id' LIMIT 1";
        $result = mysqli_query($this->connection, $sql);
        $boodschap = mysqli_fetch_assoc($result);

        return $boodschap ? $boodschap : false;
    }

    private function bijwerkenBoodschappen($artikel_id, $gebruiker_id)
    {
        $artikel_id = mysqli_real_escape_string($this->connection, $artikel_id);
        $gebruiker_id = mysqli_real_escape_string($this->connection, $gebruiker_id);

        $bijwerken = $this->artikelOpLijst($artikel_id, $gebruiker_id);

        $nieuweHoeveelheid = $bijwerken['hoeveelheid_ingredient'] + $bijwerken["hoeveelheid_verpakking"];
        $nieuweHoeveelheid = ceil($nieuweHoeveelheid);

        $sql = "UPDATE boodschappenlijst SET aantal_artikel = $nieuweHoeveelheid WHERE id = $bijwerken[id];";
        $this->connection->query($sql);
    }

    private function toevoegenBoodschappen($artikel_id, $gebruiker_id)
    {
        $artikel_id = mysqli_real_escape_string($this->connection, $artikel_id);
        $gebruiker_id = mysqli_real_escape_string($this->connection, $gebruiker_id);

        $toevoegen = $this->artikelOpLijst($artikel_id, $gebruiker_id);
        $nieuwAantal = $toevoegen["hoeveelheid_ingredient"] / $toevoegen["hoeveelheid_verpakking"];
        $nieuwAantal = ceil($nieuwAantal);

        $sql = "INSERT INTO `boodschappenlijst`( `artikel_id`, `gebruiker_id`, `aantal_artikel`) VALUES ('$artikel_id','$gebruiker_id','$nieuwAantal');";
        $this->connection->query($sql);
    }

    public function addBoodschappen($gerecht_id, $gebruiker_id)
    {
        $ingredienten = $this->getIngrediënt($gerecht_id);
    
        foreach ($ingredienten as $ingredient) {
            $artikel_id = $ingredient["artikel_id"];
            $existingBoodschap = $this->artikelOpLijst($artikel_id, $gebruiker_id);
    
            if ($existingBoodschap) {
                $this->bijwerkenBoodschappen($artikel_id, $gebruiker_id);
            } else {
                $this->toevoegenBoodschappen($artikel_id, $gebruiker_id);
            }
        }
    }
    
}
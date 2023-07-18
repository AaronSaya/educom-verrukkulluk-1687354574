<?php


class Boodschappen
{

    private $connection;
    private $ingrediënten;


    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->ingrediënten = new ingrediënt($connection);
    }

    private function getIngrediënt($gerecht_id)
    {
        return ($this->ingrediënten->selecteerIngrediënt($gerecht_id));
    }

    public function selecteerBoodschappen($gebruiker_id)
    {

        $sql = "SELECT * FROM boodschappenlijst WHERE gebruiker_id = $gebruiker_id";
        $result = mysqli_query($this->connection, $sql);
        $boodschappen = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $boodschappen;
    }

    public function artikelOpLijst($artikel_id, $gebruiker_id)
    {

        $boodschappen = $this->selecteerBoodschappen($gebruiker_id);

        foreach ($boodschappen as $boodschap) {
            if ($boodschap["artikel_id"] == $artikel_id) {
                return $boodschap;
            }
        }
        return false;
    }

    private function bijwerkenBoodschappen($artikel_id, $gebruiker_id, $hoeveelheid)
    {
        $bijwerken = $this->artikelOpLijst($artikel_id, $gebruiker_id);
        //berekening aanpassen
        $nieuweHoeveelheid = ($bijwerken['hoeveelheid_ingredient'] + ($hoeveelheid)) / $bijwerken["hoeveelheid_verpakking"];
        $nieuweHoeveelheid = ceil($nieuweHoeveelheid);

        $sql = "UPDATE boodschappenlijst SET aantal_artikel = $nieuweHoeveelheid WHERE id = $bijwerken[id];";
        $this->connection->query($sql);
    }

    private function toevoegenBoodschappen($artikel_id, $gebruiker_id, $nieuwAantal)
    {
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
            $hoeveelheid = $ingredient["hoeveelheid"];
            if ($this->artikelOpLijst($ingredient["artikel_id"], $gebruiker_id)) {
                $this->bijwerkenBoodschappen($artikel_id, $gebruiker_id, $hoeveelheid);
            } else {
                $this->toevoegenBoodschappen($artikel_id, $gebruiker_id, $hoeveelheid);
            }
        }
    }
}
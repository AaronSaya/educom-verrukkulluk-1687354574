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
        $sql = "
            SELECT a.*, bl.* 
            FROM boodschappenlijst AS bl
            LEFT JOIN artikel AS a ON bl.artikel_id = a.id
            WHERE bl.gebruiker_id = $gebruiker_id";

        $result = mysqli_query($this->connection, $sql);

        $boodschappen = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $boodschappen;
    }


    public function artikelOpLijst($artikel_id, $gebruiker_id)
    {

        $boodschappen = $this->selecteerBoodschappen($gebruiker_id);
        if ($boodschappen) {
            foreach ($boodschappen as $boodschap) {
                if ($boodschap["artikel_id"] == $artikel_id) {
                    return $boodschap;
                }
            }
        }

        return false;
    }

    public function berekenLijst($gebruiker_id)
    {
        $boodschappen = $this->selecteerBoodschappen($gebruiker_id);
        $prijsLijst = 0;

        foreach ($boodschappen as $boodschap) {
            $prijsLijst += ($boodschap["prijs"] * $boodschap["aantal_artikel"] / 2);
        }

        return $prijsLijst;
    }

    public function addBoodschappen($gerecht_id, $gebruiker_id)
    {

        $ingredienten = $this->getIngrediënt($gerecht_id);

        foreach ($ingredienten as $ingredient) {
            $artikel_id = $ingredient["artikel_id"];
            $hoeveelheidArtikel = $ingredient["hoeveelheid_verpakking"];
            $hoeveelheidIngredient = $ingredient["hoeveelheid"];

            if ($this->artikelOpLijst($ingredient["artikel_id"], $gebruiker_id)) {
                $this->bijwerkenBoodschappen($artikel_id, $gebruiker_id);
            } else {
                $this->toevoegenBoodschappen($artikel_id, $gebruiker_id, $hoeveelheidArtikel, $hoeveelheidIngredient);
            }
        }
        $totalePrijs = $this->berekenLijst($gebruiker_id);
        return $totalePrijs;
    }

    private function bijwerkenBoodschappen($artikel_id, $gebruiker_id)
    {
        $bijwerken = $this->artikelOpLijst($artikel_id, $gebruiker_id);


        if ($bijwerken["aantal_artikel"] != 0) {
            $aantalArtikel = $bijwerken['hoeveelheid_ingredient'] / $bijwerken["hoeveelheid_verpakking"] + $bijwerken["aantal_artikel"];
            $aantalArtikel = ceil($aantalArtikel);

            $sql = "UPDATE boodschappenlijst SET aantal_artikel = $aantalArtikel WHERE id = {$bijwerken['id']};";
            $this->connection->query($sql);
        } else {

        }
    }


    private function toevoegenBoodschappen($artikel_id, $gebruiker_id, $hoeveelheidArtikel, $hoeveelheidIngredient)
    {

        $aantalArtikel = $hoeveelheidIngredient / $hoeveelheidArtikel;
        $aantalArtikel = ceil($aantalArtikel);

        $sql = "INSERT INTO `boodschappenlijst`( `artikel_id`, `gebruiker_id`, `hoeveelheid_ingredient`, `hoeveelheid_verpakking`,`aantal_artikel`) VALUES ('$artikel_id','$gebruiker_id','$hoeveelheidIngredient','$hoeveelheidArtikel','$aantalArtikel');";
        $this->connection->query($sql);
    }

    public function verwijderArtikel($artikel_id, $gebruiker_id)
    {
        $artikel_id = mysqli_real_escape_string($this->connection, $artikel_id);
        $gebruiker_id = mysqli_real_escape_string($this->connection, $gebruiker_id);

        if ($artikel_id == "" && $gebruiker_id == "") {
            $sql = "DELETE FROM boodschappenlijst";
        } else {
            $sql = "DELETE FROM boodschappenlijst WHERE id = '$artikel_id' AND gebruiker_id = '$gebruiker_id'";
        }

        if (mysqli_query($this->connection, $sql)) {
            return true;
        } else {

            echo "Fout bij het uitvoeren van de query: " . mysqli_error($this->connection);
            return false;
        }
    }

}
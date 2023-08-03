<?php

class gerecht
{

    private $connection;
    private $keukentype;
    private $gebruiker;
    private $gerechtinfo;
    private $ingrediënten;



    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->keukentype = new keukenType($connection);
        $this->gebruiker = new gebruiker($connection);
        $this->gerechtinfo = new gerechtInfo($connection);
        $this->ingrediënten = new ingrediënt($connection);



    }

    private function getKeukenType($keuken_id)
    {
        return ($this->keukentype->selecteerKeukenType($keuken_id));
    }

    private function getGebruiker($gebruiker_id)
    {
        return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
    }

    private function getGerechtInfo($gerecht_id, $recordType)
    {
        return ($this->gerechtinfo->selecteerGerechtInfo($gerecht_id, $recordType));
    }


    private function getIngrediënt($gerecht_id)
    {
        return ($this->ingrediënten->selecteerIngrediënt($gerecht_id));
    }


    private function totaalPrijs($ingredienten)
    {
        $totaal = 0;
        foreach ($ingredienten as $ingredient) {
            $totaal += (int) ceil($ingredient['hoeveelheid'] / $ingredient['hoeveelheid_verpakking']) * $ingredient['prijs'];
        }
        return number_format($totaal, 2);
    }

    private function totaalCalorie($ingredienten)
    {
        $totaal = 0;
        foreach ($ingredienten as $ingredient) {
            $totaal += $ingredient['calorie'] / ($ingredient['hoeveelheid_verpakking']) * $ingredient['hoeveelheid'] / 4;

        }
        return intval($totaal);
    }

    private function berekenWaardering($waarderingen)
    {
        $aantalWaardering = count($waarderingen);
        if ($aantalWaardering == 0)
            return false;
        $nummerWaardering = 0;
        foreach ($waarderingen as $waardering) {
            $nummerWaardering += $waardering["numeriekveld"];
        }
        $gemiddeldWaardering = $nummerWaardering / $aantalWaardering;
        return $gemiddeldWaardering;
    }


    public function selecteerGerecht($id = null)
    {
        $sql = "SELECT * FROM gerecht";
    
        if ($id !== null) {
            $id = mysqli_real_escape_string($this->connection, $id);
            $sql .= " WHERE id = '$id'";
        }
    
        $result = mysqli_query($this->connection, $sql);
        $gerechten = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        $return = [];
    
        foreach ($gerechten as $gerecht) {
            $keuken = $this->getKeukenType($gerecht['keuken_id']);
            $type = $this->getKeukenType($gerecht['type_id']);
            $gebruiker = $this->getGebruiker($gerecht['gebruiker_id']);
    
            $gerechtId = $gerecht['id'];
    
            $bereidingswijze = $this->getGerechtInfo($gerechtId, "B");
            $favorieten = $this->getGerechtInfo($gerechtId, "F");
            $opmerkingen = $this->getGerechtInfo($gerechtId, "O");
            $waarderingen = $this->getGerechtInfo($gerechtId, "W");
            $ingredienten = $this->getIngrediënt($gerechtId);
            $totaalPrijs = $this->totaalPrijs($ingredienten);
            $totaalCalories = $this->totaalCalorie($ingredienten);
            $berekenWaardering = $this->berekenWaardering($waarderingen);
    
            $return[] = [
                "gerechten" => $gerecht,
                "keuken" => $keuken,
                "type" => $type,
                "gebruiker" => $gebruiker,
                "bereidingswijze" => $bereidingswijze,
                "favoriet" => $favorieten,
                "opmerkingen" => $opmerkingen,
                "waardering" => $waarderingen,
                "ingredienten" => $ingredienten,
                "totaalprijs" => $totaalPrijs,
                "totaalcalories" => $totaalCalories,
                "berekenWaardering" => $berekenWaardering,
            ];
        }
    
        return $return;
    }
    


}

?>
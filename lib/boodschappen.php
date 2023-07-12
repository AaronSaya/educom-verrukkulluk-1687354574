<?php


class Boodschappen {

private $connection;
private $ingrediënten;


public function __construct($connection){
    $this->connection =  $connection;
    $this->ingrediënten = new ingrediënt($connection);
}

private function getIngrediënt($gerecht_id) {
    return($this->ingrediënten->selecteerIngrediënt($gerecht_id));
}

    public function selecteerBoodschappen($gebruiker_id) {
       
        $sql = "SELECT * FROM boodschappenlijst WHERE gebruiker_id = $gebruiker_id";
        $result = mysqli_query($this->connection, $sql);
        $boodschappen = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $boodschappen;
    }
    

public function addBoodschappen($gerecht_id, $gebruiker_id){
    
      $ingredienten = $this->getIngrediënt($gerecht_id);

      $bijwerkenBoodschappen = [];
      $toevoegenBoodschappen =[];
            
      foreach($ingredienten as $ingredient) {      
        if($boodschap = $this->artikelOpLijst($ingredient["artikel_id"], $gebruiker_id)) {
            $bijwerkenBoodschappen = [
                "id" => $boodschap["id"],
                "hoeveelheid" => $boodschap["hoeveelheid"] + $ingredient["hoeveelheid"],
            ];
        } else {
            $toevoegenBoodschappen [] = [
                "artikel_id" => $ingredienten["artikel_id"],
                "hoeveelheid" => $ingredienten["hoeveelheid"],
            ];
        }
       
      }
    foreach($bijwerkenBoodschappen as $boodschap) {
        $bijwerken = "UPDATE boodschappen SET hoeveelheid = $boodschap[hoeveelheid] WHERE id = $boodschap[id];";
        $this->connection->query($bijwerken);
    }

    foreach ($toevoegenBoodschappen as $boodschap) {
        $toevoegen = "INSERT INTO boodschappen (gebruiker_id, artikel_id, hoeveelheid`) 
                VALUES ($gebruiker_id, {$boodschap[`artikel_id`]}, {$boodschap[`hoeveelheid`]});";
        $this->connection->query($toevoegen);
    }

    return $toevoegenBoodschappen;
 } 


    public function artikelOpLijst($artikel_id, $gebruiker_id) {

       $boodschappen = $this->selecteerBoodschappen($gebruiker_id);

       foreach($boodschappen as $boodschap) {
        if($boodschap["artikel_id"] == $artikel_id) {
            return $boodschap;
        }
       }
       return false;
  }
}
?>
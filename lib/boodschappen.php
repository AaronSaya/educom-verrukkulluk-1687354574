<?php

class Boodschappen {

private $connection;
private $ingrediënten;
private $gebruiker;



public function __construct($connection){
    $this->connection =  $connection;
    $this->ingrediënten = new ingrediënt($connection);
    $this->gebruiker = new gebruiker($connection);
}

private function getIngrediënt($gerecht_id) {
    return($this->ingrediënten->selecteerIngrediënt($gerecht_id));
}

private function getGebruiker($gebruiker_id){
    return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
}


    public function selecteerBoodschappen($id = null) {
        $sql = "SELECT * FROM gerecht";
        
        if ($id !== null) {
            $sql .= " WHERE id = $id";
        }
        
        $result = mysqli_query($this->connection, $sql);
        $gerechten = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        $return = [];
    
        foreach ($gerechten as $gerecht) {
            
            $gebruiker = $this->getGebruiker($gerecht['gebruiker_id']);
            $ingredienten = $this->getIngrediënt($gerecht['id']);

            foreach ($ingredienten as $ingredient){
            $return[] = [
     
              "gebruiker_id" => $gebruiker['id'],
              "gerechtId" => $ingredient['gerecht_id'],
              "artikelId" => $ingredient["artikel_id"],
              "naamArtikel" => $ingredient["naam_artikel"],
              "hoeveelheidGerecht" => $ingredient["hoeveelheid"],
              "prijs" =>$ingredient["prijs"],
              "calorieVerpakking" => $ingredient["calorie"],
              "hoeveeleidVerpakking" => $ingredient["hoeveelheid_verpakking"],
          
          ];
        }
        }
    
        return $return;
    }
    

public function addBoodschappen($gerecht_id, $gebruiker_id){

    
      $ingredienten = $this->getIngrediënt($gerecht_id);

      $boodschappenlijst =[];
      
      
      foreach($ingredienten as $ingredient) {      

        

        if($preLijst = $this->artikelOpLijst($ingredient["artikel_id"], $gebruiker_id)){
            $boodschappenlijst[] = [
                 "hoeveelheidVerpakking" => $preLijst["hoeveelheid_verpakking"] + $ingredient["hoeveelheid_verpakking"],
                 "prijs" => $preLijst["prijs"] + $ingredient["prijs"],
                 "calorieVerpakking" => $preLijst["calorie"] + $ingredient["calorie"],
                 ]; 
        } else {
            $boodschappenlijst[] = [

              //"artikelId" => $ingredient["artikel_id"],
              "naamArtikel" => $ingredient["naam_artikel"],
              "prijs" =>$ingredient["prijs"],
              "calorieVerpakking" => $ingredient["calorie"],
              "hoeveeleidVerpakking" => $ingredient["hoeveelheid_verpakking"],
                 
            ];
        }
      
      }
  
        return $boodschappenlijst;

    }


   
public function artikelOpLijst($artikel_id, $gebruiker_id){

       $boodschappen = $this->selecteerBoodschappen($gebruiker_id);
       while ($boodschappen["artikel_id"] == $artikel_id) {
        return $boodschappen;
       }

       return false;
    }
    
}

?>
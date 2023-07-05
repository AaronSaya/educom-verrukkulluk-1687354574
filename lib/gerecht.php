<?php

class gerecht {

    private $connection;
    private $keukentype;
    private $gebruiker;
    private $gerechtinfo;
    private $ingrediënten;
    
    

    public function __construct($connection){
        $this->connection = $connection;
        $this->keukentype = new keukenType($connection);
        $this->gebruiker = new gebruiker($connection);
        $this->gerechtinfo = new gerechtInfo($connection);
        $this->ingrediënten = new ingrediënt($connection);
       
         
        
     }

    private function getKeukenType( $keuken_id) {
        return($this->keukentype->selecteerKeukenType($keuken_id));
    }

    private function getGebruiker($gebruiker_id){
        return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
    }

    private function getGerechtInfo($gerecht_id,$recordType) {
        return($this->gerechtinfo->selecteerGerechtInfo($gerecht_id, $recordType));
    }
   

    private function getIngrediënt($gerecht_id) {
        return($this->ingrediënten->selecteerIngrediënt($gerecht_id));
    }


  
    public function selecteerGerecht($id) {
        $sql = "select * FROM gerecht WHERE id = $id";
        $result = mysqli_query($this->connection, $sql);

        $return =[];

        while ($gerecht = mysqli_fetch_array($result)){
            $keuken = $this->getKeukenType($gerecht['keuken_id'], MYSQLI_ASSOC);
            $type = $this->getKeukenType($gerecht['type_id'], MYSQLI_ASSOC);
            $gebruiker = $this->getGebruiker($gerecht['gebruiker_id'], MYSQLI_ASSOC);
         
            $gerecht_id = $gerecht['id'];
            $bereidingswijze = $this->getGerechtInfo($gerecht_id,"B");
            $favoriet = $this->getGerechtInfo($gerecht_id, "F");
            $opmerkingen = $this->getGerechtInfo($gerecht_id, "O");
            $waardering = $this->getGerechtInfo($gerecht_id, "W");
            $ingredient = $this->getIngrediënt($gerecht_id); 
            

            $return[] = [
                
                "gerecht" => $gerecht,
                "keuken" => $keuken,
                "type" => $type,
                "gebruiker" => $gebruiker,
                "bereidingsijze" => $bereidingswijze,
                "favoriet" => $favoriet,
                "opmerkingen" => $opmerkingen,
                "waardering" => $waardering,
                "ingredient" => $ingredient,
                
            
            ];
          
        }
       
        return ($return);
    }

    
    }
?>
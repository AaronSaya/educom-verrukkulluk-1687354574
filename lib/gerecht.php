<?php

class gerecht {

    private $connection;
    private $keukentype;
    private $gebruiker;
    private $gerechtinfo;
    private $ingrediënten;
    private $artikel;
    

    public function __construct($connection){
        $this->connection = $connection;
        $this->keukentype = new keukenType($connection);
        $this->gebruiker = new gebruiker($connection);
        $this->gerechtinfo = new gerechtInfo($connection);
        $this->ingrediënten = new ingrediënt($connection);
        $this->artikel = new artikel($connection);
         
        
     }

    private function getKeukenType( $keuken_id) {
        return($this->keukentype->selecteerKeukenType($keuken_id));
    }

    private function getGebruiker($gebruiker_id){
        return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
    }

    private function getBereidingswijze($gerecht_id) {
        return($this->gerechtinfo->selecteerGerechtInfo($gerecht_id));
    }
   

    private function getIngrediënt($gerecht_id) {
        return($this->ingrediënten->selecteerIngrediënt($gerecht_id));
    }

    /*private function getArtikel($artikel_id) {
        return($this->artikel->selecteerArtikel($artikel_id));
    }*/

    private function berekenPrijs($gerecht_id) {
        
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
            $bereidingswijze = $this->getBereidingswijze($gerecht_id);
            $ingredient = $this->getIngrediënt($gerecht_id); 
            

            $return[] = [
        
                "datum_toegevoegd" => $gerecht['datum_toegevoegd'],
                "titel " => $gerecht['titel'],
                "korte_omschrijving " => $gerecht['korte_omschrijving'],
                "lange_omschrijving " => $gerecht['lange_omschrijving'],
                "keuken" => $keuken,
                "type" => $type,
                "gebruiker" => $gebruiker,
                "bereidingswijze" => $bereidingswijze,
                "ingredient" => $ingredient,
                
            
            ];
          
        }
    
       
        return ($return);
    

    }
    }
?>
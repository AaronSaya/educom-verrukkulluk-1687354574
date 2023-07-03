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

     private function getKeukenType( $keukentype_id) {
        return($this->keukentype->selecteerKeukenType($keukentype_id));
    }

    private function getGebruiker($gebruiker_id){
        return ($this->gebruiker->selecteerGebruiker($gebruiker_id));
    }

    private function getGerechtInfo($gerecht_id) {
        return($this->gerechtinfo->selecteerGerechtInfo($gerecht_id));
    }

    public function selecteerGerecht($id) {
        $sql = "select * FROM ingrediënten WHERE id = $id";
        $result = mysqli_query($this->connection, $sql);

       

    

    }
    }
?>
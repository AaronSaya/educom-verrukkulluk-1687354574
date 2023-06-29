<?php


    class ingrediënt {

        private $connection;
        private $artikel;

        public function __construct($connection) {
            $this->connection = $connection;
            $this->artikel = new Artikel($connection);
        }

        public function selecteerIngrediënt($gerecht_id) {

            $sql = "SELECT * FROM ingrediënten WHERE gerecht_id = $gerecht_id";
            $result = mysqli_query($this->connection, $sql);
            $ingrediënten = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $artikelen = array();
            foreach ($ingrediënten as $ingrediënt) {
                array_push($artikelen, $this->getArtikel($ingrediënt['artikel_id']));
            }

            $ingrediëntenArtikelen = array("ingrediënten"=>$ingrediënten, "artikelen"=>$artikelen);

             return ($ingrediëntenArtikelen);
        }

        private function getArtikel($artikel_id) {
            return($this->artikel->selecteerArtikel($artikel_id));
        }
    
    }


?>
<?php

    class ingrediënt {

        private $connection;

        public function __construct($connection) {
            $this->connection = $connection;
        }

        public function selecteerIngrediënt($ingrediënt_id, $artikel_id) {

            $sql = "SELECT * FROM ingrediënten WHERE id = $ingrediënt_id and artikel_id = $artikel_id";

            $result = mysqli_query($this->connection, $sql);
            $ingrediënt = mysqli_fetch_array($result, MYSQLI_ASSOC);

            return ($ingrediënt);
        }
    }





?>
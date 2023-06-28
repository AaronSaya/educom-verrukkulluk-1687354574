<?php

class keukenType {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function selecteerKeuken($keuken) {

    $sql = "SELECT * FROM keuken_type WHERE id = $keuken AND record_type = 'K'";

    $result = mysqli_query($this->connection, $sql);
    $keuken = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return($keuken);
    }

    public function selecteerType($type) {
       
        $sql = "SELECT * FROM keuken_type WHERE id = $type ANS record_type = 'T'";

        $result = mysqli_query($this->connection, $sql);
        $type = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return $type;
    }
}
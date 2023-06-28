<?php

class keukenType {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function selecteerKeukenType($keuken) {

    $sql = "SELECT * FROM keuken_type WHERE id = $keuken";

    $result = mysqli_query($this->connection, $sql);
    $keuken = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return($keuken);
    }
}
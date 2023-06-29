<?php

class gerechtInfo {

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function selecteerGerechtInfo($gerecht_info_id) {

        $sql = "select * from gerecht_info where id = $gerecht_info_id";
       
        $result = mysqli_query($this->connection, $sql);
        $gerecht_info = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($gerecht_info);

    }
}




?>
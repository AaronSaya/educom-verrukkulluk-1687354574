<?php 


define("USER", "root");
define("PASSWORD", "Mozes29722@");
define("DATABASE", "verrukkulluk");
define("HOST", "localhost");

class database {

    private $connection;

    public function __construct() {
       $this->connection = mysqli_connect(HOST,                                          
                                         USER, 
                                         PASSWORD,
                                         DATABASE );
    }

    public function getConnection() {
        return($this->connection);
    }

}

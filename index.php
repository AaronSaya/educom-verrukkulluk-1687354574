<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/gebruiker.php");
require_once("lib/keukentype.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$kt = new keukenType($db->getConnection());


/// VERWERK 
$data = $kt->selecteerKeuken(3,4);

/// RETURN
var_dump($data);
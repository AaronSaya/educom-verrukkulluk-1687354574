<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/gebruiker.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$gbr = new gebruiker($db->getConnection());


/// VERWERK 
//$data = $art->selecteerArtikel(8);
$data = $gbr->selecteerGebruiker(4);

/// RETURN
var_dump($data);
echo ($data);
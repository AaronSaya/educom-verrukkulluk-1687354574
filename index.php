<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/gebruiker.php");
require_once("lib/keukentype.php");
require_once("lib/ingrediënten.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$kt = new keukenType($db->getConnection());
$ing = new ingrediënt($db->getConnection());


/// VERWERK 
$data = $ing->selecteerIngrediënt(1,6);

/// RETURN
var_dump($data);
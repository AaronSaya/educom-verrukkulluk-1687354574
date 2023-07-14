<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/gebruiker.php");
require_once("lib/keukentype.php");
require_once("lib/ingrediënten.php");
require_once("lib/gerecht_info.php");
require_once("lib/gerecht.php");
require_once("lib/boodschappen.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$kt = new keukenType($db->getConnection());
$ing = new ingrediënt($db->getConnection());
$gi = new gerechtInfo($db->getConnection());
$gbr = new gebruiker($db->getConnection());
$grt = new gerecht($db->getConnection());
$bsn = new boodschappen($db->getConnection());


/// VERWERK 
$dataArtikel = $art->selecteerArtikel(1);
$dataKeukenType = $kt->selecteerKeukenType(1);
$dataIngrediënt = $ing->selecteerIngrediënt(2);
$dataGerechtInfo = $gi->selecteerGerechtInfo(2, "B");
$dataGebruiker = $gbr->selecteerGebruiker(2);
$dataGerecht = $grt->selecteerGerecht();
$dataBoodschappen = $bsn->addBoodschappen(1, 1);


/// RETURN
print '<pre>';
print_r($dataBoodschappen);
print '</pre>';

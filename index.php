<?php
require_once("./vendor/autoload.php");
require_once("lib/database.php");
require_once("lib/gerecht.php");
require_once("lib/artikel.php");
require_once("lib/gebruiker.php");
require_once("lib/keukentype.php");
require_once("lib/ingrediënten.php");
require_once("lib/gerecht_info.php");
require_once("lib/boodschappenlijst.php");
// header('Content-Type: application/json; charset=utf-8');


$loader = new \Twig\Loader\FilesystemLoader("./templates");

$twig = new \Twig\Environment($loader, ["debug" => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$db = new database();
$connection = $db->getConnection();
$gerecht = new gerecht($connection);
$data = $gerecht->selecteerGerecht();
$gerechtInfo = new gerechtInfo($connection);
$rating = $gerechtInfo->addRating(1, 1, 1, 'W');


/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch ($action) {

    case "addRating" : {
            $rating = $gerechtInfo->addRating($value, $gebruiker_id, $gerecht_id, $recordType );
            break;
    }

    case "homepage": {
            $data = $gerecht->selecteerGerecht();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

    case "detail": {
            $data = $gerecht->selecteerGerecht($gerecht_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }



}

$template = $twig->load($template);

echo $template->render(["titel" => $title, "data" => $data]);


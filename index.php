<?php
require_once("./vendor/autoload.php");
require_once("lib/database.php");
require_once("lib/gerecht.php");
require_once("lib/artikel.php");
require_once("lib/gebruiker.php");
require_once("lib/keukentype.php");
require_once("lib/ingrediënt.php");
require_once("lib/gerecht_info.php");
require_once("lib/boodschappen.php");



$loader = new \Twig\Loader\FilesystemLoader("./templates");

$twig = new \Twig\Environment($loader, ["debug" => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$db = new Database();
$connection = $db->getConnection();
$gerecht = new Gerecht($connection);
$data = $gerecht->selecteerGerecht();
$gerechtInfo = new GerechtInfo($connection);
$ingredient = new Ingrediënt($connection);
$boodschappen = new Boodschappen($connection);

/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

$artikel_id = isset($_GET["artikel_id"]) ? $_GET["artikel_id"] : "";
$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";



switch ($action) {

        case "favoriet": {
                        $gebruiker_id = $_GET["gebruiker_id"];
                        if ($gerechtInfo->bepaalFavoriet($gerecht_id, $gebruiker_id)) {
                                $gerechtInfo->verwijderFavoriet($gebruiker_id, $gerecht_id);
                        } else {
                                $data = $gerechtInfo->addFavoriet($gerecht_id, $gebruiker_id);
                        }

                        header('Content-Type: application/json; charset=utf-8');

                        exit();

                }

        case "addRating": {
                        $numeriekveld = $_GET["numeriekveld"];
                        $data = $gerechtInfo->addRating($gerecht_id, $numeriekveld);
                        header('Content-Type: application/json; charset=utf-8');

                        exit();

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

        case "boodschappenlijst": {
                        $artikel_id = $_GET["artikel_id"];
                        $gebruiker_id = $_GET["gebruiker_id"];
                        $boodschappen ->selecteerBoodschappen($gebruiker_id);
                        while($boodschappen->artikelOpLijst($artikel_id, $gebruiker_id)) {
                                $boodschappen->addBoodschappen($gerecht_id, $gebruiker_id);
                        }
                        $template = 'boodschappenlijst.html.twig';
                        $title = 'boodschappenlijst';
                        break;
                }



}

$template = $twig->load($template);

echo $template->render(["titel" => $title, "data" => $data]);
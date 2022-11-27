<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

require_once "php/Player.class.php" ;
require_once "php/Game.class.php" ;
require_once "php/Page.class.php" ;
// Pourrait évoluer vers l'utilisation d'un namespace

$Player = new Player ;
$Game = new Game($Player) ;
$Page = new Page() ;

$Page->addCurrentGame($Game) ;
$Page->getActivePage() ; $Page->buildDefaultPageStructure() ;

$template = $Page->createDocumentFragment();
$template->appendXML(file_get_contents("html/".$Page->activePageName.".html"));

$Page->body->appendChild($template);


$cssLink = $Page->createElement("link")  ;

$cssLink->setAttribute("href","css/".$Page->activePageName.".css") ;
$cssLink->setAttribute("rel", "stylesheet") ;

$cssLink = $Page->head->appendChild($cssLink) ;

print_r($Page->saveHTML()) ;



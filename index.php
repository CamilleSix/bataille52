<?php
require_once 'php/0_mandatory.php' ;

require_once "php/Player.class.php" ;
require_once "php/Game.class.php" ;
require_once "php/Page.class.php" ;
// Pourrait évoluer vers l'utilisation d'un namespace

$Player = new Player ;
$Game = new Game($Player) ;

$Page = new Page('1.0', 'utf-8');

$Page->addCurrentGame($Game) ; // ajoute la session de jeu actuelle à l'objet de page

$Page->buildDefaultPageStructure() ; // crée les structures obligatoires à chaque pages (menu, head, footer)
$Page->getActivePage() ; // Récupère la vue HTML actuelle en fonction de Game et de Player

$Page->loadTemplate() ; // charge le template HTML de la vue active et ses fichiers css/js
$Page->addJsonToTemplate() ; // s'il y en a, envoie les données JSON

$Page->addCssFileToDocument() ; $Page->addJsFileToDocument() ;

echo "<!DOCTYPE html>".$Page->saveHTML() ; // sortie finale du DOM




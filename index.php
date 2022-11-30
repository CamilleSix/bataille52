<?php
    require_once 'php/0_mandatory.php' ;

    require_once "php/Player.class.php" ;
    require_once "php/Game.class.php" ;
    require_once "php/Page.class.php" ;
// Pourrait évoluer vers l'utilisation d'un namespace

    $Player = new Player ;
    $Game = new Game($Player) ;
    $Page = new Page ;

    $Page->addCurrentGame($Game) ; // ajoute la session de jeu actuelle à l'objet de page

    $Page->buildDefaultPageStructure() ; // crée les structures obligatoires à chaque pages (menu, head, footer)
    $Page->getActivePage() ; // Récupère la vue HTML actuelle en fonction de Game et de Player

    $Page->loadTemplate() ; // charge le template HTML de la vue active et ses fichiers css/js
    $Page->addCssFileToDocument() ; $Page->addJsFileToDocument() ;

    print_r("<!doctype html>".$Page->saveHTML()) ;


    // Piste d'amélioration -> Un Form.class, passer en 7.2 pour ajouter une surcouche de type sur toutes les fonctions

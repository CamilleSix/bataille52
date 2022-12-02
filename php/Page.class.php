<?php

class Page extends DOMDocument{

    public $activePageName = "index" ;
    public $Game ;
    public $head ;
    public $html ;
    public $body ;
    public $main ;
    public $footer;

    public $cssFiles = ['0_mandatory'] ;
    public $jsFiles = ['0_mandatory'] ;

    function addCurrentGame($Game){
        $this->Game = $Game;
    }

    function addTextToNode($element, $text){
        $textNode = $this->createTextNode($text) ;
        $element->appendChild($textNode) ;
    }


    function buildDefaultPageStructure(){
        // crée la structure HTML de base obligatoire de toutes les pages
        $this->html = $this->createElement("html");
        $this->appendChild($this->html) ;

        $this->head = $this->createElement("head");
        $this->html->appendChild($this->head) ;

        $this->body = $this->createElement("body");
        $this->html->appendChild($this->body) ;

        $this->main = $this->createElement("main");
        $this->body->appendChild($this->main) ;

        $this->footer = $this->createElement("footer");

        $footerLink = $this->createElement("a");
        $footerLink->setAttribute('href', "https://github.com/CamilleWemajin/bataille52") ;
        $footerLink->setAttribute('target', "_blank") ;

        $this->addTextToNode($footerLink,"@bataille52 - Voir sur Github");
        $this->footer->appendChild($footerLink) ;

        $this->body->appendChild($this->footer) ;

        $this->displayError() ;
    }

    function getActivePage(){
        // Va chercher la vue HTML correspondante, en fonction de l'objet Player et de l'objet Game

        if (empty($this->Game->Player->name)){
            // si le nom du joueur n'est pas renseigné, la page à renvoyer est obligatoirement le formulaire demandant le prénom
            $this->activePageName = "playerFormName" ;
        } elseif ($this->Game->displayedResult == true){
            // le joueur a demandé la page des résultats !
            $this->activePageName = "results" ;
        } else {
            $this->activePageName = "game" ;
        }

        return $this->activePageName ;
    }

    function loadTemplate(){
        $template = $this->createDocumentFragment();
        $template->appendXML(file_get_contents("html/".$this->activePageName.".html"));
        // récupère la vue HTML correspondant à la page active

        $this->main->appendChild($template); // insère la vue dans le <main> de l'objet de page


        $this->cssFiles[] = $this->activePageName ;
        $this->jsFiles[] = $this->activePageName ;
    }

    function addJsonToTemplate(){

        $jsonGameData = '' ;

        if ( $this->activePageName  == "results"){
            $jsonGameData = $this->Game->gameResultToJson() ;
        } else if ( $this->activePageName  == "game") {
            $jsonGameData = $this->Game->gameDataToJson() ;
        }

        $divWithJson = $this->createElement("div");
        $divWithJson->setAttribute('id', "gameJsonData") ;
        $this->addTextToNode($divWithJson,$jsonGameData ) ;
        $this->body->appendChild($divWithJson) ;

    }

    function addCssFileToDocument(){

        foreach ($this->cssFiles AS $cssFile) {
            if (file_exists("css/" . $cssFile . ".css")) {
                $cssLink = $this->createElement("link");
                $cssLink->setAttribute("href", "css/" . $cssFile . ".css");
                $cssLink->setAttribute("rel", "stylesheet");

                $this->head->appendChild($cssLink);
            }
        }
    }
    function addJsFileToDocument(){

        foreach ($this->jsFiles AS $jsFile) {
            if (file_exists("js/" . $jsFile . ".js")) {
                $jsLink = $this->createElement("script");
                $jsLink->setAttribute("src", "js/" . $jsFile . ".js");

                $this->head->appendChild($jsLink);
            }
        }
    }

    function displayError(){

        if (isset($_SESSION['Errors'])){
            $errors = $this->createElement("ul");
            $errors->setAttribute("class", "errorsParent");
            foreach ($_SESSION['Errors'] AS $errorMessage){
                $error = $this->createElement("li");
                $error->setAttribute("class", "errorMessage");

                $this->addTextToNode($error,$errorMessage);
                $errors->appendChild($error);
            }

            $this->body->insertBefore($errors, $this->main) ;
            unset($_SESSION['Errors']);
            // remet à zéro la session avec les erreurs puisque qu'elles ont été affichées
        }
    }


}


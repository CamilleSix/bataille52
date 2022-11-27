<?php

class Page extends DOMDocument{

    public $activePageName = "index" ;
    public $Game ;
    public $head ;
    public $body ;

    function addCurrentGame($Game){
        $this->Game = $Game;
    }


    function buildDefaultPageStructure(){
        // crée la structure HTML de base obligatoire de toutes les pages

        $this->head = $this->createElement("head");
        $this->appendChild($this->head) ;

        $this->body = $this->createElement("main");
        $this->appendChild($this->body) ;

        $footer = $this->createElement("footer");
        $this->body->appendChild($footer) ;
    }

    function getActivePage(){
        // Va chercher la vue HTML correspondante, en fonction de l'objet Player et de l'objet Game

        if (empty($this->Game->Player->name)){
            // si le nom du joueur n'est pas renseigné, la page à renvoyer est obligatoirement le formulaire demandant le prénom
            $this->activePageName = "playerFormName" ;
        }
    }


}


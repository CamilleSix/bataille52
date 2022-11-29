<?php

    class Page extends DOMDocument{

        public $activePageName = "index" ;
        public $Game ;
        public $head ;
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

            $this->head = $this->createElement("head");
            $this->appendChild($this->head) ;

            $this->body = $this->createElement("body");
            $this->appendChild($this->body) ;

            $this->main = $this->createElement("main");
            $this->body->appendChild($this->main) ;

            $this->footer = $this->createElement("footer");
            $this->addTextToNode($this->footer,"https://github.com/CamilleWemajin/bataille52");

            $this->body->appendChild($this->footer) ;

            $this->displayError() ;
        }

        function getActivePage(){
            // Va chercher la vue HTML correspondante, en fonction de l'objet Player et de l'objet Game

            if (empty($this->Game->Player->name)){
                // si le nom du joueur n'est pas renseigné, la page à renvoyer est obligatoirement le formulaire demandant le prénom
                $this->activePageName = "playerFormName" ;
            }

            return $this->activePageName ;
        }

        function loadTemplate(){
            $template = $this->createDocumentFragment();
            $template->appendXML(file_get_contents("html/".$this->activePageName.".html"));
            // récupère la vue HTML correspondant à la page active

            $this->main->appendChild($template); // insère la vue dans le <main> de l'objet de page
            $this->cssFiles[] = $this->activePageName ;
        }

        function addCssFileToDocument(){

            foreach ($this->cssFiles AS $cssFile) {

                $cssLink = $this->createElement("link");
                $cssLink->setAttribute("href", "css/" . $cssFile . ".css");
                $cssLink->setAttribute("rel", "stylesheet");

                $this->head->appendChild($cssLink);
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


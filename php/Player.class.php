<?php

    class Player{

        public $name ;
// Ca fait pas un objet très utile, je pensais avoir besoin de plus de choses !

        public function __construct(){
            if (!empty($_SESSION['Player'])){
                // il y a une session avec les informations du joueur, on peut donc récupérer son prénom
                $this->name = $_SESSION['Player'] ;
            }
            // Il n'y a pas d'information de session pour l'utilisateur, il faut lui demander son prénom

        }


    }


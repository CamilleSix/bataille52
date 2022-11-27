<?php

class Player{

    public $name ;

    public function __construct(){
        if (!empty($_SESSION['player'])){
            // il y a une session avec les informations du joueur, on peut donc récupérer son prénom

        } else {
            // Il n'y a pas d'information de session pour l'utilisateur, il faut lui demander son prénom

        }
    }

    public function validName(){

    }
}


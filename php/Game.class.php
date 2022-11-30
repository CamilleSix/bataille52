<?php

    class Game{

        public $Player  ;
        private $cards = [];

        public $playerCards = [] ;
        public $botCards = [] ;
        private $displayedResult = false ;

        public function __construct($Player){


            if (!isset($_SESSION['Game'])){

                for ($i = 1; $i <= 52; $i++){
                    $this->cards[] = $i ;
                } // pour respecter les consignes, les cartes c'est 52 nombres sans double, mais ca sera modifiable ici si besoin
                $this->newGame() ;
                // si la session Game n'est pas trouvée, on créer les informations avec le tirage des cartes

            } else {
                // la session existe, c'est donc un jeu terminé ou dont le résultat n'a pas été affiché
                foreach ( $_SESSION['Game'] AS $key => $previousGame){
                    $this->$key = $previousGame ;
                }
            }

            $this->Player = $Player ;
        }

        public function newGame(){

            shuffle($this->cards); // mélange les cartes (on peut relancer plusieurs shuffle à la suite si on veut que ce soit bien mélanger, bien sur)

            $middle = count($this->cards) / 2 ; // 26 donc

            $this->playerCards = array_slice($this->cards,0, $middle);
            $this->botCards = array_slice($this->cards,$middle);

            $_SESSION['Game'] = $this ;

        }

        public function gameDataToJson(){
            return json_encode(["playerCards"=>$this->playerCards,"botCards"=>$this->botCards]) ;
        }


    }


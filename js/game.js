window.addEventListener('load', function () {

    let gameJsonData = document.getElementById('gameJsonData').innerText;
    gameJsonData = JSON.parse(gameJsonData) ; // on récupère les données JSON de mon traitement PHP (on pourrait imaginer un retour d'API sur le même principe pour éviter l'écriture dans le DOM)

    let triggerFlipAction = document.querySelectorAll('.currentCard') ;

    let playerParts = ["bot", "player"] ; // Si un jour on fait une bataille à 3, on change le code en commençant par ici

    let remainCardsNumber = document.querySelector(".remainCardsNumber span") ; // 26 donc, comme indiqué dans la vue, on pourrait aussi faire un count sur "playerCards"

    let flipped = false ; // bool qui permet de savoir si les cartes sont retournées ou non et d'empècher le flood de "flipCard()"

    let finishedGame = document.getElementById("finishedGame") ; // mon message de fin de partie qui est caché

    let currentPointer = 0 ; // le pointer actuel qui commence sur le premier element du tableau JSON

    function setNumberToCard(partName){
        let domParent = document.querySelector("." + partName + "Part .currentCard") ;
        domParent.querySelector("span").innerText = gameJsonData[partName + "Cards"][currentPointer] ;
    }

    function flipCard(){
        if (currentPointer < 26) { // sécurité pour éviter qu'un joueur ne masque le layout et cherche à cliquer la carte une fois de trop
            // on pourrait définitivement variabiliser "le nombre de manches" plutôt que de mettre "26"

            if (currentPointer === 0) {
                // c'est le premier clic, on peut masquer la consigne
                document.querySelector('.disclamer').style.display = "none";
            }
            flipped = true;
            for (let i = 0; i < playerParts.length; i++) {
                let domParent = document.querySelector("." + playerParts[i] + "Part");
                setNumberToCard(playerParts[i]);

                domParent.classList.add('flipped');
            }
            if (gameJsonData["botCards"][currentPointer] > gameJsonData["playerCards"][currentPointer]) {
                setPoints(document.querySelector(".botPart .points span"), document.querySelector(".playerPart .points span"));
            } else {
                setPoints(document.querySelector(".playerPart .points span"), document.querySelector(".botPart .points span"));
            }

            currentPointer++;
            let remainNewNumber = parseInt(remainCardsNumber.innerText) - 1;
            remainCardsNumber.innerText = remainNewNumber;

            if (remainNewNumber === 0) {
                finishedGame.style.display = "block";
                // les manches sont finies, on affiche le formulaire
            }
        }
    }
    function setPoints(winner,looser){
        // fonction qui attribue les +1 à chaque manque et change le trophée pour le mettre sur le joueur actuellement en tête
        let previous = parseInt(winner.innerText) ;
        winner.innerText = ""+ (previous + 1) ;

        let otherPlayerPoints = parseInt(looser.innerText) ;

        looser.parentNode.classList.remove('winner') ;
        winner.parentNode.classList.remove('winner') ;

        if ((previous +1) > otherPlayerPoints) {
            winner.parentNode.classList.add('winner');
        } else if ((previous +1) < otherPlayerPoints){
            looser.parentNode.classList.add('winner') ;
        }

        if (previous === 1) {
            winner.parentNode.innerHTML += "s" ;
        }
    }
    function next(){
        for (let i = 0; i < playerParts.length; i++) {
            document.querySelector("." + playerParts[i] + "Part").classList.remove('flipped');
        }
        flipped = false ;
    }

    for (let i = 0; i < triggerFlipAction.length; i++){
        // ajoute un écouteur sur les 2 cartes
        triggerFlipAction[i].addEventListener('click', function (){
            if (flipped === false) {
                flipCard();
            } else {
                next();
            }
        })
    }

    document.querySelector('.playerName').innerText = gameJsonData["playerName"] ;
    // Insére le nom du joueur dans la vue

}) ;
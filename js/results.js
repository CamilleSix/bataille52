window.addEventListener('load', function () {

    let winnerMessage = document.getElementById("winnerMessage")

    let gameJsonData = document.getElementById('gameJsonData').innerText;
    gameJsonData = JSON.parse(gameJsonData) ;

    if (gameJsonData['playerPoints'] > gameJsonData['botPoints'] ){
        winnerMessage.innerHTML = "<strong>"+ gameJsonData['playerName']+"</strong>, vous avez gagné contre l'ordinateur !<br>Avec un total de <strong class='winNumber'>"+ gameJsonData['playerPoints'] +"</strong> manches gagnées contre <strong class='looseNumber'>"+ gameJsonData['botPoints'] +"</strong>" ;

    } else if (gameJsonData['playerPoints'] === gameJsonData['botPoints'] ){
        winnerMessage.innerHTML = "Egalité entre <strong>"+ gameJsonData['playerName']+"</strong> et l'ordinateur !<br></br>Avec <strong class='winNumber'>"+ gameJsonData['playerPoints'] +"</strong> maches gagnées des deux côtés." ;
    } else {
        winnerMessage.innerHTML = "Dommage, l'ordinateur a gagné...<br>Avec un total de <strong class='looseNumber'>"+ gameJsonData['playerPoints'] +"</strong> manches gagnées contre <strong class='winNumber'>"+ gameJsonData['botPoints'] +"</strong>" ;
    }

    document.getElementById('loadResult').innerHTML = gameJsonData["htmlTableResult"] ;

}) ;
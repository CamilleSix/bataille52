<?php
    require_once '../php/0_mandatory.php' ;

    if (isset($_POST['playerName']) && strlen($_POST['playerName']) >= 3){
        // Note : il est donc interdit de s'appeler "Jo" ou "Ed", il sera possible d'accepter ces prénoms excentrique en passant la vérifications de 3 à 2
        $_SESSION['Player'] = htmlentities($_POST['playerName'], ENT_QUOTES) ;
        // htmlentities() par aquis de conscience sachant que SESSION est difficilement corruptible et sera ici utilisée uniquement pour de l'affichage
    } else {
        // message d'erreur
        $_SESSION['Errors'][] = "Erreur" ; // Message d'erreur qui affiche sobrement, "erreur", parce que c'est une ereur du coup
    }
    header("Location:../");
?>
<?php
require_once '../php/0_mandatory.php' ;

if (isset($_POST['goTo']) && $_POST['goTo']== "results"){
    $_SESSION['Game']['displayedResult'] = true ;
    // on passe le param à la session pour qu'il soit détecté sur la page suivante et ouvre la bonne vue
} else {
    unset($_SESSION['Game']) ;
    // Nouveau jeu ? on supprime juste la session !
}

header("Location:../");
?>
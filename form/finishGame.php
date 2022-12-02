<?php
require_once '../php/0_mandatory.php' ;

if (isset($_POST['goTo']) && $_POST['goTo']== "results"){
    $_SESSION['Game']['displayedResult'] = true ;
} else {
    unset($_SESSION['Game']) ;
}

header("Location:../");
?>
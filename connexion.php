<?php
session_start();
require 'fonctions.php';
if(isset($_POST['btnconnexion']))
{
        $affichage = authentification($_POST['txtlogin'],$_POST['txtmdp']);
        if(isset($affichage['rows'][0]['professeur_id'])) {
            $_SESSION['professeur_id'] = $affichage['rows'][0]['professeur_id'];
            $_SESSION['hidden_id'] = $affichage['rows'][0]['_id'];
            $_SESSION['prenom_professeur'] = $affichage['rows'][0]['prenom'];
            header('Location: mesevaluations.php');
        }
        else
            echo "Login ou mot de passe invalide(s).";

}

if(isset($_POST['btndeconnexion']))
{
    session_unset();
    session_destroy();
}
?>
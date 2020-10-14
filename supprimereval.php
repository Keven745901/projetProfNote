<?php
require "fonctions.php";

if(isset($_GET['eval'])){
    supprimerEvaluation($_GET['eval']);
    supprimerNotes();
    header("Location: mesevaluations.php");
}
?>
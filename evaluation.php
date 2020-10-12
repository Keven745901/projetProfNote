<?php
require "fonctions.php";
if(isset($_GET['eval']))
{

    $notes = reponseFiltree('Note','evaluation_id', $_GET['eval'], 'contains');

    $somme = 0;
    $nb = 0;

    echo "<h1>$_GET[libelle]</h1>";
    echo "<h2>Coefficient " . $_GET['coefficient'] . "</h2>";
    foreach ($notes['rows'] as $item) {
        echo $item['eleve_nom'] . " <input type='text' value='" . $item['valeur'] . "'>";
        echo "<br><br>";
        $nb = $nb + 1;
    }
    echo "<br>";
}
?>
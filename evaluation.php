<?php
require "fonctions.php";
if(isset($_GET['eval']))
{

    $eleves = reponseFiltree('Eleve','classe_code', $_GET['classe'], 'contains');
    
    $somme = 0;
    $nb = 0;

    echo "<h1>$_GET[libelle]</h1>";
    echo "<h2>Coefficient " . $_GET['coefficient'] . "</h2>";
    foreach ($eleves['rows'] as $item) {
        echo $item['prenom'];
        echo "<br><br>";
        $nb = $nb + 1;
    }
    echo "<br>";
}
?>
<?php
require "fonctions.php";
if(isset($_GET['eval']))
{
    //$notes = reponseFiltree('Evaluation','classe_id',$_GET['classe'], 'contains');
    $idClasse = reponseFiltree('Classe','_id', $_GET['classe'], 'contains');
    $eleves = reponseFiltree('Eleve','classe_id', $idClasse['rows']['classe_id'], 'contains');


    $somme = 0;
    $nb = 0;

    echo "<h1>$_GET[libelle]</h1>";
    echo "<h2>Coefficient " . $_GET['coefficient'] . "</h2>";
    foreach ($eleves['rows'] as $item) {
        echo $item['prenom'];
        echo "<br><br>";
        $somme = $somme + $item['valeur'];
        $nb = $nb + 1;
    }
    echo "<br>";
    if($nb>0)
        echo "Moyenne : " . $somme/$nb;
}
?>
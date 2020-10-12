<?php
require "fonctions.php";
if(isset($_GET['eval']))
{
    echo $_GET['classe'];
    //$notes = reponseFiltree('Evaluation','classe_id',$_GET['classe'], 'contains');
    $eleves = reponseFiltree('Eleve','classe_id', 'sgfsdgCGC', 'contains');

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
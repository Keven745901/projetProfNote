<?php
    session_start();
    require "fonctions.php";
    if(isset($_SESSION['professeur_id']))
    {
        $evals = reponseFiltree('Evaluation','professeur_id',$_SESSION['professeur_id'], 'contains');

        if(isset($evals['rows'][0]['evaluation_id'])) {
            foreach ($evals['rows'] as $item) {
                echo "<a href='evaluation.php?eval=$item[evaluation_id]&libelle=$item[libelle]&coefficient=$item[coefficient]&classe=". $item['classe_code'] ."'>" . $item['libelle'] . "</a> " . $item['evaluation_date'] . " <a style='color:red' href='supprimereval.php?eval=$item[_id]'>Supprimer</a>";
                echo "<br>";
            }
        }
        else
            echo "Pas d'évaluations à afficher.";
    }
    else{
        echo "Pas connecté.";
    }
?>
<?php

if(isset($_GET['btnvalider']) && isset($_SESSION['hidden_id']))
{
    $eval = ajouterEval($_GET['txtlibelle'], $_GET['dtpdate'], $_GET['txtcoef']);

    $maclasse=reponseFiltree('Classe','classe_code',$_GET['cboclasse'],'contains');
    $maclasseID = $maclasse['rows'][0]['_id'];

    ajouterLiensEval($eval['_id'], $maclasseID, $_SESSION['hidden_id']);

    //Ajout d'une note pour chaque élève
    initNotes($maclasse['rows'][0]['Eleve'], $eval['_id']);

    $evaluation_id = reponseFiltree('Evaluation','professeur_id',$_SESSION['professeur_id'], 'contains');
	$derniereEval = end($evaluation_id['rows']);

	header('Location: evaluation.php?eval=' . $derniereEval['evaluation_id'] . "&libelle=" . $derniereEval['libelle'] . "&coefficient=" . $derniereEval['coefficient'] . "&classe=" . $derniereEval['classe_code']);
	
}
?>
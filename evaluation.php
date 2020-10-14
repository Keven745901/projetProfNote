<?php
    session_start();

    require "fonctions.php";
    if(isset($_GET['eval']) || $_SESSION['notes']){
    
        if(!isset($_GET['eval'])){
            $_GET['eval'] = $_SESSION['eval'];
            $_GET['libelle'] = $_SESSION['libelle'];
            $_GET['coefficient'] = $_SESSION['coefficient'];
        }
        else{
            $_SESSION['eval'] = $_GET['eval'];
            $_SESSION['libelle'] = $_GET['libelle'];
            $_SESSION['coefficient'] = $_GET['coefficient'];
        }
        $notes = reponseFiltree('Note','evaluation_id', $_GET['eval'], 'contains');
        $_SESSION['notes']=$notes;

        if(isset($_GET['btnsubmit'])){
            majValeurNotes($_SESSION['notes']['rows']);
        }

        $somme = 0;
        $nb = 0;
        echo "<form method='GET' action='evaluation.php'>";
        echo "<h1>$_GET[libelle]</h1>";
        echo "<h2>Coefficient " . $_GET['coefficient'] . "</h2>";
        $notes = reponseFiltree('Note','evaluation_id', $_GET['eval'], 'contains');
        $_SESSION['notes']=$notes;
        foreach ($notes['rows'] as $item) {
            if(!isset($item['valeur']))
                $manote = "";
            else
                $manote = $item['valeur'];
            echo $item['eleve_nom'] . " <input type='text' value='" . $manote . "' name='" . $item['eleve_id'][0] . "'>";
            echo "<br><br>";
            $nb = $nb + 1;
        }
        echo "<input type='submit' name='btnsubmit' value='Envoyer'>";
        echo "</form>";
    }
?>

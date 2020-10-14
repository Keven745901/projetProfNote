<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Création Evaluation</title>
</head>
<body>
<?php
    require "fonctions.php";

    if(!isset($_SESSION['professeur_id']))
        header('Location: index.php');

    $classe = reponseFiltree('Classe', 'professeur_id', $_SESSION['professeur_id'], 'contains');

?>
<form method="GET">
    <label for="txtlibelle">Libelle :</label>
    <input type="text" name="txtlibelle" required="required" placeholder="Libelle">
    <br /><br />
    <label for="txtdate">Date de l'évaluation :</label>
    <input type="date" name="dtpdate" required="required" placeholder="Libelle">
    <br /><br />
    <label for="txtlibelle">Coefficient :</label>
    <input type="text" name="txtcoef" required="required" placeholder="Coefficient">
    <br /><br />
    <label for="cboclasse">Choisissez une classe:</label>
    <select name="cboclasse">
        <?php
        foreach ($classe['rows'] as $item) {
            echo "<option value='$item[classe_code]'>$item[libelle]</option>";
            echo "<br>";
        }
        ?>
    </select>
    <br /><br />
    <input type="submit" name="btnvalider" value="Valider les informations">
    <?php require"ajouterevaluation_script.php"; ?>
</form>
</body>
</html>
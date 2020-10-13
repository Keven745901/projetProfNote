<?php
session_start();

require "fonctions.php";
if(isset($_GET['eval']) || $_SESSION['notes'])
{
    
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
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

    $headers = array();
    $headers[] = "Authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4";
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';

    

    foreach ($_SESSION['notes']['rows'] as $item) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n\t\"row\": {\"valeur\":\"" . $_GET[$item['eleve_id'][0]] . "\"},
        \"table_name\":\"Note\",\"row_id\":\"" . $item['_id'] . "\"}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
    }


    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    else {
        echo "<br />";
        $eval = json_decode($result,true);
    }
    curl_close($ch);
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

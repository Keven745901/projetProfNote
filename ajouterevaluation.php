<?php
if(isset($_GET['btnvalider']))
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n\t\"row\": {\"libelle\": \"$_GET[txtlibelle]\",\"evaluation_date\": \"$_GET[dtpdate]\",\"coefficient\": \"$_GET[txtcoef]\",\"classe_id\": \"$_GET[cboclasse]\",\"professeur_id\": \"$_SESSION[professeur_id]\"},\n\n\t\"table_name\": \"Evaluation\"\n\n}");

    $headers = array();
    $headers[] = "Authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4";
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    else {
        echo("Votre évaluation a bien été créée !");
        echo "<br />";
        echo $result;
        echo "<br />";
        echo $_GET['cboclasse'];
        echo "<br />";
        echo $_SESSION['professeur_id'];
    }
    curl_close($ch);

}
?>
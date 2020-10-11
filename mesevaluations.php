<?php
session_start();
if(isset($_SESSION['professeur_id']))
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/filtered-rows/?table_name=Evaluation",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{\"filters\" : 
            [{\"column_name\":\"professeur_id\",
            \"filter_predicate\":\"contains\",
            \"filter_term\":\"$_SESSION[professeur_id]\",
            \"filter_term_modifier\": \"\"}
            ]}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2NjA2NzEsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.T-jAwcSalJm3NDhBR-A0ZukUNkSugcRLSgbAItNSDq8",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }
    else {
        $affichage = json_decode($response, true);
        if(isset($affichage['rows'][0]['evaluation_id'])) {
            foreach ($affichage['rows'] as $item) {
                echo "<a href='evaluation.php?$item[evaluation_id]'>" . $item['libelle'] . "</a> " . $item['evaluation_date'];
                echo "<br>";
            }
        }
        else
            echo "Pas d'évaluations à afficher.";
    }
}
else{
    echo "Pas connecté.";
}
?>
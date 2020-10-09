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
            [{\"column_name\":\"libelle\",
            \"filter_predicate\":\"contains\",
            \"filter_term\":\"Ev\",
            \"filter_term_modifier\": \"\"},
            
            {\"column_name\":\"libelle\",
            \"filter_predicate\":\"contains\",
            \"filter_term\":\"a\",
            \"filter_term_modifier\": \"\"}
            ],
            \"filter_conjunction\":\"And\"
            }",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDIzNTY2MDgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.NKAke-X7-ICr1gulCb-rf9w68ZjgvOdNZPPZQWXB-y4",
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
        echo $response;
        if(isset($affichage['rows'][0]['evaluation_id'])) {
            echo "<br>";
            echo $affichage['rows'][0]['libelle'];
            echo "<br>";
            echo $affichage['rows'][0]['evaluation_date'];
            echo "<br>";
            echo $affichage['rows'][0]['professeur_id'][0];
        }
        else
            echo "Pas d'évaluations à afficher.";
    }
}
else{
    echo "Pas connecté.";
}
?>
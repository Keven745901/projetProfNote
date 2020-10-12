<?php

if(isset($_GET['btnvalider']) && isset($_SESSION['hidden_id']))
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n\t\"row\": {\"evaluation_id\":\"" . random() . "\",\"libelle\": \"$_GET[txtlibelle]\",\"evaluation_date\": \"$_GET[dtpdate]\",\"coefficient\": \"$_GET[txtcoef]\"},\n\n\t\"table_name\": \"Evaluation\"\n\n}");

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
        $eval = json_decode($result,true);
    }
    curl_close($ch);

    $maclasse=reponseFiltree('Classe','classe_code',$_GET['cboclasse'],'contains');
    $maclasseID = $maclasse['rows'][0]['_id'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/links/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"table_name\": \"Evaluation\",\n\"other_table_name\": \"Classe\",\n\"link_id\": \"YqS4\",\n\"table_row_id\": \"" . $eval['_id'] . "\",\n\"other_table_row_id\": \"" . $maclasseID . "\"\n}\n",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/links/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"table_name\": \"Evaluation\",\n\"other_table_name\": \"Professeur\",\n\"link_id\": \"361V\",\n\"table_row_id\": \"" . $eval['_id'] . "\",\n\"other_table_row_id\": \"$_SESSION[hidden_id]\"\n}\n",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }




//Ajout d'une note pour chaque élève
$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    

    $headers = array();
    $headers[] = "Authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4";
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    
    foreach ($maclasse['rows'][0]['Eleve'] as $eleve) 
    {
    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');   
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n\t\"row\": {\"note_id\":\"" . random() . "\"},\n\n\t\"table_name\": \"Note\"\n\n}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //add link élève
    $result = curl_exec($ch);
    $result = json_decode($result,true);
    $idNote = $result['_id'];

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/links/');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\t\"table_name\": \"Note\",\n\"other_table_name\": \"Eleve\",\n\"link_id\": \"fi65\",\n\"table_row_id\": \"" . $idNote . "\",\n\"other_table_row_id\": \"" . $eleve . "\"\n}\n");

    $result = curl_exec($ch);

    //add link éval
    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/links/');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\t\"table_name\": \"Note\",\n\"other_table_name\": \"Evaluation\",\n\"link_id\": \"mKC9\",\n\"table_row_id\": \"" . $idNote . "\",\n\"other_table_row_id\": \"" . $eval['_id'] . "\"\n}\n");

    $result = curl_exec($ch);
    }

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    else {
        echo("Votre évaluation a bien été créée !");
        echo "<br />";
        $eval = json_decode($result,true);
    }
    curl_close($ch);






}
?>
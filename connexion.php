<?php
session_start();
require 'fonctions.php';
if(isset($_POST['btnconnexion']))
{
    /*$curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/filtered-rows/?table_name=Professeur",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{\"filters\" : 
            [{\"column_name\":\"login\",
            \"filter_predicate\":\"is\",
            \"filter_term\":\"$_GET[txtlogin]\",
            \"filter_term_modifier\": \"\"},
            
            {\"column_name\":\"mdp\",
            \"filter_predicate\":\"is\",
            \"filter_term\":\"$_GET[txtmdp]\",
            \"filter_term_modifier\": \"\"}
            ],
            \"filter_conjunction\":\"And\"
            }",
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
    else {
        $affichage = json_decode($response, true);*/
        $affichage = authentification($_POST['txtlogin'],$_POST['txtmdp']);
        if(isset($affichage['rows'][0]['professeur_id'])) {
            $_SESSION['professeur_id'] = $affichage['rows'][0]['professeur_id'];
            $_SESSION['hidden_id'] = $affichage['rows'][0]['_id'];
            echo $affichage['rows'][0]['prenom'];
            echo "<input type='submit' name='btndeconnexion' value='Déconnexion'>";
        }
        else
            echo "Login ou mot de passe invalide(s).";
    //}
}

if(isset($_POST['btndeconnexion']))
{
    session_unset();
    session_destroy();
}
?>
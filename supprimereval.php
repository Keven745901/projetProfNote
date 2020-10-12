<?php
require "fonctions.php";

if(isset($_GET['eval'])){
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_POSTFIELDS, 
	"{
	\"table_name\": \"Evaluation\",
    \"row_id\": \"$_GET[eval]\"
	}"
);

$headers = array();
$headers[] = 'Authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4';
$headers[] = 'Accept: application/json';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);



//récupération des notes dont l'éval est nulle dans une liste
$curl = curl_init();

    	curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/filtered-rows/?table_name=Note",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{\"filters\" : 
            [{\"column_name\":\"evaluation_nom\",
            \"filter_predicate\":\"is_empty\"}
            ]}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4",
            "content-type: application/json"
        	),
    	));

    	$notesSupp = curl_exec($curl);
    	$err = curl_error($curl);

    	curl_close($curl);

    	if ($err) 
        	echo "Une erreur est survenue.";

    	else
    		echo $notesSupp;
}



//suppression de ces notes
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

$headers = array();
$headers[] = 'Authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI2ODIxOTgsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.0W4G8Y841meSF5prFFZIXArC6wUPHfeizVaF3-xlQI4';
$headers[] = 'Accept: application/json';
$headers[] = 'Content-Type: application/json';

$notesSupp=json_decode($notesSupp,true);
foreach($notesSupp['rows'] as $item){
	curl_setopt($ch, CURLOPT_POSTFIELDS, 
	"{
	\"table_name\": \"Note\",
    \"row_id\": \"" . $item['_id'] . "\"
	}"
);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_exec($ch);
}

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
//header("Location: mesevaluations.php");
?>
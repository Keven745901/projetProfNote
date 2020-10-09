<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n\t\"row\": {\"valeur\": \"12\" , \"coefficient\": \"3\"},\n\n\t\"table_name\": \"Note\"\n\n}");

$headers = array();
$headers[] = 'Authorization: Token eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDI0ODU2MTMsImR0YWJsZV91dWlkIjoiMTAwNzUyOTc4ZmEzNDYwMzkyMjZkYmU1NGE2YTNhNmEiLCJ1c2VybmFtZSI6ImJmODBlMTE5YzczYzQ5YjU4MTBhMGUxNjliNDEwZGU4QGF1dGgubG9jYWwiLCJwZXJtaXNzaW9uIjoicncifQ.V3oceMKDhZUt1cupOkOl_C4L5kQNRSrJqWr7SraA89Q';
$headers[] = 'Accept: application/json';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>
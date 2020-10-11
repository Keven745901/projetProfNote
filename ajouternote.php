<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Note</title>
</head>
<body>
    <form method="GET" action="ajouternote.php">
        <input type="text" name="valeur" placeholder="valeur" required="required">
        <br>
        <input type="text" name="coefficient" placeholder="coefficient" required="required">
        <br><br>
        <input type="submit" name="ajouter" value="Ajouter">
        <br><br>
    </form>
</body>
</html>

<?php

if(!isset($_GET['valeur']) && !isset($_GET['coefficient'])){
	echo "Entrez les infos svp";
}

if(isset($_GET['ajouter'])){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		"{
			\"row\": 
				{\"valeur\": \"$_GET[valeur]\",
				\"coefficient\": \"$_GET[coefficient]\"},
			\"table_name\": \"Note\"
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
}
?>
<?php
require "fonctions.php";
echo reponseFiltree('Note','valeur','','contains');
	if(isset($_GET['eval']))
	{
		$notes = reponseFiltree('Note','evaluation_id',$_GET['eval'], 'contains');
		$somme = 0;
		$nb = 0;

		echo "<h1>$_GET[libelle]</h1>";
		echo "<h2>Coefficient " . $_GET['coefficient'] . "</h2>";

	}

if(isset($_GET['btnsubmit'])) {
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/links/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\n\t\"table_name\": \"Note\",\n\"other_table_name\": \"Evaluation\",\n\"link_id\": \"mKC9\",\n\"table_row_id\": \"PG4OyZuVQ5C_ZLzJ73I0Cw\",\n\"other_table_row_id\": \"Sa_r-uBQTByBEf1PWgsjsQ\"\n}\n",
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
} else {
    echo $response;
}

}

?>
<form>
    <textarea id="donnees_excel"></textarea>
    <br>
    <input type="button" value="Convertir" onclick="convertirTableau()"></input>
    <br>
    <table id="tableau" border="1">

    </table>
    <br><br>
    <input type="submit" name="btnsubmit" value="Envoyer">
</form>
<script>
    function convertirTableau()
    {
        document.getElementById('tableau').innerHTML = '<th>Etudiant</th><th>Note</th>';
        var txt = document.getElementById('donnees_excel').value;
        txt.trim();
        txt = txt.replaceAll("\t",";");
        txt = txt.replaceAll("\n",";");
        var liste = txt.split(";");
        for(var i=0;i<liste.length-1;i=i+2){
                var ligne = document.getElementById("tableau").insertRow(-1);
                var colonne1 = ligne.insertCell(0);
                colonne1.innerHTML += liste[i];
                var colonne2 = ligne.insertCell(1);
                 colonne2.innerHTML += liste[i+1];
        }
    }
</script>
<?php
require "token.php";

	function reponseFiltree($table, $colonne, $filtre, $operateur){
		global $token;
		$curl = curl_init();
		

    	curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/filtered-rows/?table_name=" . $table,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{\"filters\" : 
            [{\"column_name\":\"" . $colonne . "\",
            \"filter_predicate\":\"" . $operateur . "\",
            \"filter_term\":\"" . $filtre . "\",
            \"filter_term_modifier\": \"\"}
            ]}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token " . $token,
            "content-type: application/json"
        	),
    	));
    	$response = curl_exec($curl);
        $err = curl_error($curl);
      
    	curl_close($curl);

    	if ($err) 
        	echo "Une erreur est survenue.";
    	return json_decode($response,true);
	}

function random()
{
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(15/strlen($x)) )),1,15);
}

function majValeurNotes($notes){
	global $token;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

    $headers = array();
    $headers[] = "Authorization: Token " . $token;
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';

    foreach ($notes as $item) {
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


function ajouterEval($libelle,$date,$coef){
	global $token;
$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n\t\"row\": {\"evaluation_id\":\"" . random() . "\",\"libelle\": \"" . $libelle . "\",\"evaluation_date\": \"" . $date . "\",\"coefficient\": \"" . $coef . "\"},\n\n\t\"table_name\": \"Evaluation\"\n\n}");

    $headers = array();
    $headers[] = "Authorization: Token " . $token;
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    else {
        $eval = json_decode($result,true);
    }
    curl_close($ch);
    return json_decode($result,true);
}

function ajouterLiensEval($evalID, $classeID, $hiddenID){
	global $token;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/links/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"table_name\": \"Evaluation\",\n\"other_table_name\": \"Classe\",\n\"link_id\": \"YqS4\",\n\"table_row_id\": \"" . $evalID . "\",\n\"other_table_row_id\": \"" . $classeID . "\"\n}\n",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token " . $token,
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
        CURLOPT_POSTFIELDS => "{\n\t\"table_name\": \"Evaluation\",\n\"other_table_name\": \"Professeur\",\n\"link_id\": \"361V\",\n\"table_row_id\": \"" . $evalID . "\",\n\"other_table_row_id\": \"" . $hiddenID . "\"\n}\n",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token " . $token,
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }
}

function initNotes($meseleves, $evalID){
	global $token;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    

    $headers = array();
    $headers[] = "Authorization: Token " . $token;
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    
    foreach ($meseleves as $eleve) 
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
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\t\"table_name\": \"Note\",\n\"other_table_name\": \"Evaluation\",\n\"link_id\": \"mKC9\",\n\"table_row_id\": \"" . $idNote . "\",\n\"other_table_row_id\": \"" . $evalID . "\"\n}\n");

    $result = curl_exec($ch);
    }

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    else {
        echo("Votre évaluation a bien été créée !");
        echo "<br />";
        //$eval = json_decode($result,true);
    }
    curl_close($ch);
}


function supprimerEvaluation($monEvaluation)
{
	global $token;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
        "{
        \"table_name\": \"Evaluation\",
        \"row_id\": \"".  $monEvaluation . "\"
        }"
    );

    $headers = array();
    $headers[] = 'Authorization: Token ' . $token;
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}

function supprimerNotes()
{
	global $token;
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
        "authorization: Token " . $token,
        "content-type: application/json"
        ),
    ));

    $notesSupp = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) 
        echo "Une erreur est survenue.";

    

    //suppression de ces notes
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://cloud.seatable.io/dtable-server/api/v1/dtables/100752978fa346039226dbe54a6a3a6a/rows/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    $headers = array();
    $headers[] = 'Authorization: Token ' . $token;
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
    
}

function authentification($login,$mdp)
{
	global $token;
    $curl = curl_init();

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
            \"filter_term\":\"" . $login . "\",
            \"filter_term_modifier\": \"\"},
            
            {\"column_name\":\"mdp\",
            \"filter_predicate\":\"is\",
            \"filter_term\":\"" . $mdp . "\",
            \"filter_term_modifier\": \"\"}
            ],
            \"filter_conjunction\":\"And\"
            }",
        CURLOPT_HTTPHEADER => array(
            "authorization: Token " . $token,
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    echo $response;
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $affichage = json_decode($response, true);
        return $affichage;
    }
}

?>
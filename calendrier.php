<?php 
	session_start();
	require "fonctions.php";
?>

<!DOCTYPE html>
<html>
<head>
   <script src="scheduler/codebase/dhtmlxscheduler.js" type="text/javascript"></script>
   <link rel="stylesheet" href="scheduler/codebase/dhtmlxscheduler_material.css" 
        type="text/css">
        <script src="scheduler/codebase/locale/locale_fr.js" charset="utf-8"></script>
</head>
<body>

	<?php
		$curl = curl_init();
		$evalsProf = reponseFiltree('Evaluation','professeur_id',$_SESSION['professeur_id'],'contains')['rows'];
	?>

   <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100vh;'>
        <div class="dhx_cal_navline">
            <div class="dhx_cal_prev_button">&nbsp;</div>
            <div class="dhx_cal_next_button">&nbsp;</div>
            <div class="dhx_cal_today_button"></div>
            <div class="dhx_cal_date"></div>
            <div class="dhx_cal_tab" name="day_tab"></div>
            <div class="dhx_cal_tab" name="week_tab" ></div>
            <div class="dhx_cal_tab" name="month_tab"></div>
        </div>
        <div class="dhx_cal_header"></div>
        <div class="dhx_cal_data"></div>       
   </div>
   <script type="text/javascript">

	var evalsProfJSON = <?php echo json_encode($evalsProf); ?>;
	var i = 0;

	var classes = [];
	var couleurs = [];

     scheduler.config.readonly = true;
     scheduler.init("scheduler_here", new Date(), "month");
     evalsProfJSON.forEach(item =>{
     	if(classes.includes(item['classe_id'][0])==false){
     		classes.push(item['classe_id'][0]);
     		couleurs.push(getRandomColor());
     	}

     	var index = classes.indexOf(item['classe_id'][0]);
     	var couleur = couleurs[index];

		scheduler.parse([
   		{id:i, start_date:item['evaluation_date'],end_date:item['evaluation_date'],text:item['classe_libelle'], color:couleur, textColor:"white"}],"json");
   		i = i + 1;
     });
     console.log(classes);
     console.log(couleurs);


     function getRandomColor() {
  var letters = '0123456789AB';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 12)];
  }
  return color;
}

   </script>
</body>
</html>
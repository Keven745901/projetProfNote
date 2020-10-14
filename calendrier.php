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

	var couleurs = [];

     scheduler.init("scheduler_here", new Date(), "month");
     evalsProfJSON.forEach(item =>{
     	if(couleurs.includes(item['classe_id'][0])==false){
     		couleurs.push(item['classe_id'][0]);
     	}


		scheduler.parse([
   		{id:i, start_date:item['evaluation_date'],end_date:item['evaluation_date'],text:"Evaluation", color:"orange"}],"json");
   		i = i + 1;
     });
     console.log(couleurs);
   </script>
</body>
</html>
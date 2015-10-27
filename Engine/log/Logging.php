<?php

/*
Programa para ejecutar la función de logging y riderccionar a la página de ejercicios.
*/

//include("Log_Files.php"); 

//// Captura datos enviados por URL /////////////////////////////

$user_id    = $_GET['user_id']; 		// Flashvar (user_guid)
$course_id  = $_GET['course_id']; 		// Flashvar (course_guid)
$cont_eje   = $_GET['cont_eje'] + 1; 		// Contador de ejercicios
//$file_name  = $_GET['file_name']; 	// .log file
//$sig_eje    = $_GET['sig_eje']; 		// ID ejercicio actual
$file_path  = $_GET['file_path']; 		// Path de ejercicio actual
$cidReq    = $_GET['cidReq']; 			// ID del curso

//Save_DB($file_name,$course_id,$user_id,$sig_eje);
//header("Refresh: 0; url=http://lcc.ens.uabc.mx/~siec/ITS/Fracciones/algo-1.php?user_id=1&course_id=1&num_eje=2");

if($cont_eje <=3)
{
  // header("Refresh: 0; url=http://lcc.ens.uabc.mx/~its/".$file_path.".php?user_id=".$user_id."&course_id=".$course_id."&num_eje=".$num_eje);
  header("Refresh: 0; url=http://lcc.ens.uabc.mx/~siec/ITS/".$file_path.".php?user_id=".$user_id."&course_id=".$course_id."&cont_eje=".$cont_eje."&cidReq=".$cidReq);
}
else
{
//  Save_Stats_DB($file_name,$course_id,$user_id);

  echo "<script>history.go(-4)</script>";
}
	
?>

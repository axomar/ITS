<?php

/*
Programa para ejecutar la funci�n de logging y riderccionar a la p�gina de ejercicios.
*/

include("Log_Files.php"); 

//// Captura datos enviados por URL /////////////////////////////
$user_id   = $_GET['user_id']; 		// Flashvar (user_guid)
$course_id = $_GET['course_id']; 	// Flashvar (course_guid)
$num_eje   = $_GET['num_eje']; 		// Contador de ejercicios
$file_name = $_GET['file_name']; 	// .log file
$sig_eje   = $_GET['sig_eje']; 		// ID ejercicio actual
$file_path = $_GET['file_path']; 	// Path de ejercicio actual

Save_DB($file_name,$course_id,$user_id,$sig_eje);

if($num_eje <=3)
{
  header("Refresh: 0;url=http://lcc.ens.uabc.mx/~its/".$file_path.".php?user_id=".$user_id."&course_id=".$course_id."&num_eje=".$num_eje);
}
else
{
  Save_Stats_DB($file_name,$course_id,$user_id);

  echo "<script>history.go(-4)</script>";
}
	
?>

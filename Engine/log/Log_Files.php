<?php

/*
Funciones para leer, convertir e importar datos a BDs de los .log files generados por el nuevo sistema.

Omar Álvarez-Xochihua
16/08/15
*/

// DELETE FROM `its_logging` WHERE `user_id` = 555
// DELETE FROM `its_summary` WHERE `user_id` = 555

/// Función que obtiene datos de la BD y determina el grado de avance del
/// estudiante en el set de ejercicios terminados.
/// y guarda la estadística en la BD 
function Save_Stats_DB($course_id,$user_id,$cidReq)
{
 $exercise_code	= substr($course_id,0,3);
 $cont			= 0;
 $hints			= 0;
 $errors		= 0;
 $total			= 0;
 $elapsed_time  = 0;
 
/// Se recuperan los registros del ejercicio actual

$result = mysql_query("SELECT * FROM its_summary WHERE user_id =".$user_id." AND exercise_id LIKE '%".$exercise_code."%' ORDER BY date desc, time desc");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

/// Ciclo para recorrer los tres últimos registros y determinar
/// el progreso del alumno. Se le otorgan:
/// 1) 33 puntos por pregunta correcta sin errores ni ayuda
/// 2) 30 puntos por respuesta correcta, sin ayuda pero con 
///    errores, se le resta 1 puntos por error
/// 3) 15 puntos por respuesta correcta, si solicitó ayuda

while($row=mysql_fetch_array($result) and $cont<3) 
{$elapsed_time += $row['elapsed_time'];

 if($row['hints']>0)			//Solicitó ayuda
 { $hints += $row['hints'];
  if ($row['errors']>0)		//Con ayuda, con errores
  { $errors += $row['errors'];
    if ($row['result']==1)      //Con ayuda, con errores, ok
    { $total += 5;			//Suma 5 puntos, sino no suma 
    }
  } 
  else				     //Con ayuda, sin errores
  {if ($row['result']==1)       //Con ayuda, sin errores, ok
   { $total += 15;			//Suma 5 puntos, sino no suma 
   }
  }
 } 
 else						//No solicitó ayuda
 {if ($row['errors']>0)		//Sin ayuda, con errores
  { $errors += $row['errors'];
    if ($row['result']==1)      //Sin ayuda, con errores, ok
    {$total +=30-($row['errors']*1);	//Resta 5 puntos por error 
    }
  } 
  else				     //Sin ayuda, sin errores
  {if ($row['result']==1)       //Sin ayuda, sin errores, ok
   { $total += 33;			//Suma 33 puntos 
   }
  }
 }  
 $cont++;
}


if ($total==99)     //Todoc correcto sin ayuda
 $total=100;		//Puntaje total 

/// Registros para datos estadísticos en archivo its_stats

$query 	= "insert into its_stats values ('".$user_id."','".$exercise_code."', NOW(), CURTIME(),'".$hints."','".$errors."','".$total."','".$elapsed_time."','".$cidReq."')";
 mysql_query($query) or die (mysql_error());
 mysql_close($enlace);
}

/////////////////////////// main() /////////////////////////////////////////////////////////////

 $postdata = file_get_contents("php://input");
 $request = json_decode($postdata);

 //// Data retrieval
 $user_id     = $_GET['user_id']; 		
 $course_id   = $_GET['course_id']; 	
 $cidReq 	  = $_GET['cidReq'];
 $exercise_id = $_GET['exercise_id']; 	
 $cont_eje    = $_GET['cont_eje']; 	
 $course_id   = $course_id . '-' . strval($exercise_id);


 //// Variables for summary table
 $initial_date	= "";
 $initial_time	= "";
 $help   		= 0;
 $errors		= 0;
 $result		= 0;
 $elapsed_time	= 0;
 $answers		= array();


 //// Conexión a la BD e inserción de datos
 $enlace =  mysql_connect('localhost','siec','siec2013');
 if (!$enlace) 
 {
	die('No pudo conectarse: ' . mysql_error());
 }

 mysql_select_db(siec) or die("Cannot select database!<br>" . mysql_error());
 
 $feedback = array();
 $cont=0;
 $input=0;
 
 // Get feedback from json element
 $feedback[0]="Empty";
 foreach ($request->results as $logData)
 {  
	if($cont > 0)
	{
	 $cont2 = 0;
	 foreach ($logData->result as $res) 
	 {
	  if($input == $cont2)
		$feedback[$cont-1] = $res->resp;
	  $answers[$cont2] = "";
	  $cont2++;
	 }
	}
	else
	{
	 $initial_date	= $logData->date;
	 $initial_time	= $logData->time;
	}
	$input = intval($logData->input);
	$cont++;
 }
 
 //Save log data into the DB 
 $cont=0; 
 $cont_ok=0;
 foreach ($request->results as $logData) 
 {
  $date        = $logData->date;
  $time        = $logData->time;
  $action      = "Input " . $logData->input . "->" . $logData->data;
  $information = $feedback[$cont];
  
  $query 	= "insert into its_logging values ('".$user_id."','".$course_id."','".$date."','".$time."','".$action."','".$information."','".$cidReq."')";
  mysql_query($query) or die (mysql_error());
  
  if(($information == 'ok') && ($answers[$logData->input] == ""))
  { 
	  $answers[$logData->input] = 'ok';
	  $cont_ok++;
  }
  /// Cálculo de datos generales
  $cont++;
  
  if ($logData->data == 'Help on')
	$help++;
  elseif($information == 'mal')
	$errors++;
  elseif($cont_ok == $cont2)		// ($logData->input == $cont2-1) and ($information =='ok')
	$result = 1;
 }

 // Estimate summary data
  $tiempo	= explode(":",$initial_time);
  $segundos	= $tiempo[2];
  $minutos 	= $tiempo[1];
  $horas 	= $tiempo[0];
  $elapsed_time = $segundos + ($minutos * 60) + ($horas * 3600);

  $tiempo	= explode(":",$time);
  $segundos	= $tiempo[2];
  $minutos 	= $tiempo[1];
  $horas 	= $tiempo[0];
  $end_time 	= $segundos + ($minutos * 60) + ($horas * 3600);

  $elapsed_time = $end_time - $elapsed_time;

 /// Registros general en archivo its_summary
 $query = "insert into its_summary values ('".$user_id."','".$course_id."','".$initial_date."','".$initial_time."','".$help."','".$errors."','".$result."','".$elapsed_time."','".$cidReq."')";
 mysql_query($query) or die (mysql_error());
  
 if($cont_eje == 3)
 {
  Save_Stats_DB($course_id,$user_id,$cidReq);
 }
 
 mysql_close($enlace);

?>
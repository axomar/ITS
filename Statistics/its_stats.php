<?php

/*
Funciones para estimar grado de avance de estudiantes en forma particular y general, obtiene detos de BDs del ITS generados por el sistema CTAT y Chamilo.

Omar Álvarez-Xochihua
12/08/13
*/

//////////////////////////////////////////
/// Obtiene datos de la BD (its_stats & its_sections) 
/// sobre el grado de avance del estudiante por ejercicio y por /// lección. Estos datos son presentados en los archivos lp_list /// & .... de Chamilo (/chamilo/main/newscorm).
function Student_General_Progress($course_id, $user_id)
{
/* Ya existe conexión a la BD en el archivo que lo utiliza
 //// Conexión a la BD para consulta de datos de alumno
 $enlace =  mysql_connect('localhost','siec','siec2013');
 if (!$enlace) 
 {die('No pudo conectarse: ' . mysql_error());
 }

 mysql_select_db(siec) or die("Cannot select database!<br>" . mysql_error());

 $exercise_code	= substr($in_file,0,3);
 $cont		= 0;
 $hints		= 0;
 $errors		= 0;
 $elapsed_time  = 0;
*/

 $total		= 0;

/// Se recuperan el número de ejercicios por lección

  $result_sections = mysql_query("SELECT section_id, count(*) AS num_eje FROM its_sections WHERE course_id = '".$course_id."' GROUP BY section_id ORDER BY section_id ASC");

  if (!$result_sections) 
  {echo 'Could not run query: ' . mysql_error();
   exit;
  }

//inicializo el array que almacenará el contador por ejercicios
$num_ejercicios 	= array();

while($row=mysql_fetch_array($result_sections)) 
 $num_ejercicios[$row['section_id']] = $row['num_eje'];


/// Se recuperan registros de ejercicios realizados por alumno

  $result_stats = mysql_query("SELECT user_id, its_stats.exercise_code, section_id, date, time, result FROM its_stats, its_sections WHERE its_stats.exercise_code=its_sections.exercise_code AND course_id = '".$course_id."' AND user_id = ".$user_id." AND time IN (SELECT MAX(time) FROM its_stats  WHERE user_id=".$user_id." GROUP BY exercise_code,date) ORDER BY exercise_code, date DESC");

  if (!$result_stats) 
  {echo 'Could not run query: ' . mysql_error();
   exit;
  }


//inicializo el array que almacenará las lecciones
$lecciones 	= array();
$temp_section 	= "";
$temp_exercise 	= "";

while($row=mysql_fetch_array($result_stats)) 
{
  if($row['section_id'] == $temp_section)
  {if($row['exercise_code'] != $temp_exercise)
   {$total += $row['result'];
    $temp_exercise = $row['exercise_code'];
   }
  }  
  else
  {
   if($temp_section != "")
   {$lecciones[$temp_section]=round($total/$num_ejercicios[$temp_section]); 
    $total = 0;
   }
   $temp_exercise = $row['exercise_code'];
   $temp_section = $row['section_id'];
   $total += $row['result'];
  }
}

$lecciones[$temp_section]=round($total/$num_ejercicios[$temp_section]); 

 //mysql_close($enlace);

 return $lecciones;
}

//////////////////////////////////////////
/// Obtiene datos de la BD (its_stats) 
/// sobre el grado de avance del estudiante por ejercicio 
/// Estos datos son presentados en el archivo learnpath.class 
/// de Chamilo (/chamilo/main/newscorm).
function Student_Exercise_Progress($exercise_code, $user_id)
{

/// Se recuperan registros de ejercicios realizados por alumno

  $result_stats = mysql_query("SELECT result FROM its_stats WHERE user_id = ".$user_id." AND exercise_code = '".$exercise_code."' ORDER BY date DESC, time DESC LIMIT 1");

  if (!$result_stats) 
  {echo 'Could not run query: ' . mysql_error();
   exit;
  }

  $row=mysql_fetch_array($result_stats); 
  
  return $row['result'];
}

?>
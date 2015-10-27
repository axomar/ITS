<?php

/*
Funciones para leer, convertir e importar datos a BDs de los .log files generados por el sistema CTAT.

Omar Álvarez-Xochihua
20/07/13
*/

//// Convierte código escaped a caracteres originales
function Token($element)
{

 $TOKENS = array
 (  "20" => " ",
    "3C" => "<",
    "3E" => ">",
    "23" => "#",
    "25" => "%",
    "7B" => "{",
    "7D" => "}",
    "7C" => "|",
    "5E" => "^",
    "7E" => "~",
    "5B" => "[",
    "5D" => "]",
    "60" => "`",
    "3B" => ";",
    "2F" => "/",
    "3F" => "?",
    "3A" => ":",
    "40" => "@",
    "3D" => "=",
    "26" => "&",
    "24" => "$",
    "0A" => "	",
    "09" => "	",
    "22" => '"',
 );

 return $TOKENS[$element];
}

//// Recibe archivo a convertir y genera versión unescaped.
function Log_Converter($in_file) 
{
  $file=fopen($in_file,"r") or exit("No se pudo abrir el archivo!".$in_file);
  while(!feof($file))
  {
    $bufer = htmlspecialchars(fgets($file)). "<br />";
  }
  fclose($file);

  echo "CONTENIDO DEL ARCHIVO<br>";
  echo $bufer;

  echo "<br><br>CONTENIDO CONVERTIDO<br>";
  $token    = explode("%", $bufer);

  foreach($token as $element)
  {
	$pos = strpos($element, "?xml");
	if ($pos > 0)
	{if(substr($element,0,2)=="0A")
	  {
		$element = substr($element, 21);
		echo "</log_action>";
	  }
	 echo "·········································<br>";
	 echo $element."<br>"; 
	}
	else
	{
      if (strlen($element)==2)
	 {
	  echo Token($element)." ";
	  if(Token($element)==">")
	   echo "<br>";
	 }
      else
	 {
	  echo Token(substr($element,0,2))." ";
	  echo substr($element,2)." ";
	  if(Token(substr($element,0,2))==">")
		echo"<br>";
	 }
	}
  }
}


//// Recibe .log file y regresa registros para DB
function Data_Retrieval($in_file)
{
  $data 			= "";
  $temp_string		= "";
  $temp_element 		= 0;
  $complete_label 	= FALSE;

  $file=fopen($in_file,"r") or exit($in_file);
  while(!feof($file))
  {
    $bufer = htmlspecialchars(fgets($file)). "<br />";
  }
  fclose($file);

  $token    = explode("%", $bufer);

  foreach($token as $element)
  {
	$pos = strpos($element, "?xml");
	if ($pos > 0)
	{if(substr($element,0,2)=="0A")
	  {
		$element = substr($element, 21);
		$data .= "///";
		$temp_element = 0;
	  }
	  if($pos = strpos($element, "date_time="))
		{$data .= substr($element,$pos+16,25);}

	  if($pos = strpos($element, "action_id="))
		{
		 $temp_string .= substr($element,$pos,50);
		 if ($pos=strpos($temp_string,"context_message"))
		   {
		    $data .= ";;;context_message";
		    $temp_element = 1;
		   }
		 elseif ($pos=strpos($temp_string, "tool_message"))
		   {
		    $data .= ";;;tool_message";
		    $temp_element = 2;
		   }
		 elseif ($pos=strpos($temp_string, "tutor_message"))
		   {
		    $data .= ";;;tutor_message";
		    $temp_element = 3;
		   }
		}
	}
	else
	{
	 if (strlen($element)==2)
	 {
	  $temp_string = Token($element)." ";
	  if(Token($element)==">")
	   $complete_label = TRUE;
	 }
      else
	 {
	  $temp_string .= Token(substr($element,0,2))." ";
	  $temp_string .= substr($element,2)." ";
	  if(Token(substr($element,0,2))==">")
		$complete_label = TRUE;
	 }
	 if ($complete_label == TRUE)
	 {
	  switch($temp_element)
	  {
  	    case 2:
		if($pos = strpos($temp_string, "< selection >"))
		 {$data .= ";;;".substr($temp_string,$pos+14);}
		if($pos = strpos($temp_string, "< input >"))
		 {$data .= "->".substr($temp_string,$pos+10);}
	     break;
  	    case 3:
		if($pos=strpos($temp_string,"< action_evaluation >"))
		 {$data .= ";;;".substr($temp_string,$pos+22);}
		if($pos = strpos($temp_string, "< tutor_advice >"))
		 {$data .= "->".substr($temp_string,$pos+17);}
	     break;
	  }
	  $complete_label = FALSE;
	  $temp_string = "";
	 } 
	}
  }
  return $data;
}

/// Obtiene datos de la función que convierte el .log file
/// (Data_Retrieval) y los guarda en la BD 
function Save_DB($in_file,$course_id,$user_id,$exe_id)
{
 chdir("../../CognitiveTutorAuthoringTools/logfiles/".$course_id."/Est-".$user_id."/");  	//log directory path
 foreach (glob($in_file) as $file_name); 

 $data = Data_Retrieval($file_name);	//Datos para BDs

 

 //// Conexión a la BD e inserción de datos
 $enlace =  mysql_connect('localhost','siec','siec2013');
 if (!$enlace) 
 {
	die('No pudo conectarse: ' . mysql_error());
 }

 mysql_select_db(siec) or die("Cannot select database!<br>" . mysql_error());

 
 $records = explode("///", $data);

 $initial_date	= substr($data,0,10);
 $initial_time	= substr($data,11,8);
 $exercise		= substr($file_name,0,4). $exe_id;
 $hints		= 0;
 $errors		= 0;
 $result		= 0;
 $elapsed_time	= 0;


 foreach($records as $record)
 {
   if (strlen($record)>25)
   {
 	$fields 	= explode(";;;", $record);
    	$date		= substr($fields[0],0,10);
    	$time 	= substr($fields[0],11,8);
///$temp = $initial_time . "---" . $time;
    //	$exercise	= substr($file_name,0,4). $exe_id;
	$action	= $fields[1];
	if($pos = strpos($action, "utor_message->"))
	{
	 $action		= "tutor_message";
	 $information	= substr($fields[1],15);
	}
	else
	{
	 $information	= $fields[2];
	}

/// Cálculo de datos generales

	if (strpos($information,'hint') !== false)
	  $hints++;
	elseif (strpos($information,'InCorrect') !== false)
	  $errors++;
	elseif (strpos($information,'Correct') !== false)
	  $result = 1;
///$information = $temp;
/// Registros individuales en archivo its_logging
    	$query 	= "insert into its_logging values ('".$user_id."','".$exercise."','".$date."','".$time."','".$action."','".$information."')";
    mysql_query($query) or die (mysql_error());
   }
}

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


//$elapsed_time = strtotime($time) - strtotime($initial_time);

 /// Registros general en archivo its_summary
$query 	= "insert into its_summary values ('".$user_id."','".$exercise."','".$initial_date."','".$initial_time."','".$hints."','".$errors."','".$result."','".$elapsed_time."')";
 mysql_query($query) or die (mysql_error());
 mysql_close($enlace);
}

//////////////////////////////////////////
/// Obtiene datos de la BD y determina el grado de avance del
/// estudiante en el set de ejercicios terminados.
/// y guarda la estadística en la BD 
function Save_Stats_DB($in_file,$course_id,$user_id)
{

 //// Conexión a la BD para consulta e inserción de datos
 $enlace =  mysql_connect('localhost','siec','siec2013');
 if (!$enlace) 
 {
	die('No pudo conectarse: ' . mysql_error());
 }

 mysql_select_db(siec) or die("Cannot select database!<br>" . mysql_error());

 $exercise_code	= substr($in_file,0,3);
 $cont		= 0;
 $hints		= 0;
 $errors		= 0;
 $total		= 0;
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
///    errores, se le resta 5 puntos por error
/// 3)  5 puntos por respuesta correcta, si solicitó ayuda

while($row=mysql_fetch_array($result) and $cont<3) {

$elapsed_time += $row['elapsed_time'];

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
   { $total += 5;			//Suma 5 puntos, sino no suma 
   }
  }
} 
else						//No solicitó ayuda
{if ($row['errors']>0)		//Sin ayuda, con errores
  { $errors += $row['errors'];
    if ($row['result']==1)      //Sin ayuda, con errores, ok
    {$total +=30-($row['errors']*5);	//Resta 5 puntos por error 
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


if ($total==99)     	//Todoc correcto sin ayuda
 $total=100;		//Puntaje total 

/// Registros para datos estadísticos en archivo its_stats

$query 	= "insert into its_stats values ('".$user_id."','".$exercise_code."', NOW(), CURTIME(),'".$hints."','".$errors."','".$total."','".$elapsed_time."')";
 mysql_query($query) or die (mysql_error());
 mysql_close($enlace);
}

?>
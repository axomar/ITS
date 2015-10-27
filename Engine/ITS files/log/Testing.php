<?php

/*
Programa para probar el funcionamiento de las funciones de la librería Log_Files.php.
*/

include("Log_Files.php"); 

chdir("../../CognitiveTutorAuthoringTools/logfiles/ITSM2013/Est-10/");  	//log directory path

$file_name = "EXP-10-2_20130722134540333.log";
Log_Converter($file_name);
//Test($file_name);
	
?>

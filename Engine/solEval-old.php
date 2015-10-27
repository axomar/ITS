<?php
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$opciones = array('ok','mal','neutro');
$exercise_id = "../" . $_GET['exercise']."-DT.xml";
include("evalmath.class.php");

// Cálcula el Mínimo Común Divisor
function mcd($a,$b) { 
 while (($a % $b) != 0) { 
  $c = $b; 
  $b = $a % $b; 
  $a = $c; 
 } 
 return $b; 
} 

// Cálcula el Mínimo Común Multiplicador
function mcm($a,$b) { 
 return ($a * $b) / mcd($a,$b); 
} 



// Determina si el valor insertado por el usuario es correcto.
function Evaluation($id, $value, $input, $exercise_id, $operatorData) 
{
 $m = new EvalMath;

 $xml=simplexml_load_file($exercise_id) or die("Error: Cannot create object");
 
 $count_options = $xml->input[$id]->count();
 for ($i = 0; $i < $count_options; $i++) 
 {
  $operator = $xml->input[$id]->option[$i]->operator;
  $equation = trim($xml->input[$id]->option[$i]->equation);
  $data = explode(" ", $equation);
  
  $equation   = "";
  $operatorDT = "";


  if($operator == 'IF')
  {
   $trimmed = intval(ltrim($data[0], "v"));
   $equation .= $input[$trimmed];		 

   switch($data[1]) 
   {
    case "==": 
			if($equation == $data[2]) 
			  {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;
			  }
			  break;
    case "!=": if($equation != $data[2]) 
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
    case "GT": if($equation > $data[2]) 
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
    case "GE": if($equation >= $data[2]) 
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
    case "LT": if($equation < $data[2]) 
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;			  
    case "LE": if($equation <= $data[2]) 
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
   }	// SWITCH
  }
  else
  {
   foreach ($data as $element) 
   {
      if (is_numeric($element)) 
	  {	   
		$equation .= $element;
	  } 
	  else 
	  { if($element[0] == 'o')
		{
		 $operatorDT   = ltrim($element, "o");
		}
		elseif (strpos($element,'v') === False)
		{ 
		 $equation .= $element;
		}
		else
		{ 
		 $trimmed = intval(ltrim($element, "v"));
         $equation .= $input[$trimmed];
		}		 
	  }
   }
//	return $equation[3];
//	  $equation = "mcm(2,4)";

  if(strstr($equation,"mcm"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = mcm(intval($valor[0]), intval($valor[1]));
  }
  else
	  $equation_result = $m->evaluate($equation);
  if($operatorDT == "")
	  $operatorData="";
 
// return strval($equation_result);
 
  switch($operator) 
  {
    case "==":if(($equation_result == $value) && ($operatorDT == $operatorData)) 
			  {return $xml->input[$id]->option[$i]->result;
		  
			    $i=$count_options;
			  }
			  break;
    case "!=": if(($equation_result != $value) && ($operatorDT == $operatorData))
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
    case "GT": if(($equation_result > $value) && ($operatorDT == $operatorData))
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
    case "GE": if(($equation_result >= $value) && ($operatorDT == $operatorData)) 												
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
    case "LT": if(($equation_result < $value) && ($operatorDT == $operatorData)) 
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;			  
    case "LE": if(($equation_result <= $value) && ($operatorDT == $operatorData))
			   {return $xml->input[$id]->option[$i]->result;
			    $i=$count_options;			
			   }
			  break;
   }	// SWITCH
  }  	// else IF
 }		// option's LOOP
}

//PROGRAMA PRINCIPAL
$contResp     = 0;
$cont         = 0;
$operatorData = "";

foreach ($request->result2 as $valor2) {
   $data[$cont] = $valor2->value;
   if(!is_numeric($data[$cont]))
	  $operatorData = $data[$cont];
   $cont++;
}

$cont = 0;
foreach ($request->result as $valor) 
{ 
 if($valor->value == "")
	$valor->resp = 'neutro';
 else
 {
   $hint=Evaluation($cont, $valor->value, $data, $exercise_id, $operatorData);
   if($hint == 'ok')
   {
	$valor->ayuda = array('Correcto!');
    $valor->resp = 'ok';
   }
   else
   { $valor->ayuda = $hint;
	 $valor->resp = 'mal';
   }
 }
 $cont++;
}

 print_r(json_encode($request->result));
 

?>

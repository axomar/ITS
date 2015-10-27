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

// Cálcula el Maximo Común Divisor
function gcd($a,$b) {
    $a = abs($a); $b = abs($b);
    if( $a < $b) list($b,$a) = Array($a,$b);
    if( $b == 0) return $a;
    $r = $a % $b;
    while($r > 0) {
        $a = $b;
        $b = $r;
        $r = $a % $b;
    }
    return $b;
}

// Simplifica numerador de una fraccion
function smn($num,$den) {
    $g = gcd($num,$den);
    return $num/$g;
}

// Simplifica denominador de una fraccion
function smd($num,$den) {
    $g = gcd($num,$den);
    return $den/$g;
}

// Cociente de division
function cod($num,$den) {
    $c =floor($num / $den);
	if($c < 0)
		$c++;
    return $c;
}

// Residuo de division
function red($num,$den) {
    $c =floor($num / $den);
	if($c < 0)
		$c++;
	$c = $num - ( $den * $c );
    return $c;
}

// Compara cadenas
function txt($a,$b) { 
 if($a == $b)
	return $a;
 else
	return '';
} 

// Compara cadenas
function condicional($value1, $operator, $value2) {
   $result = FALSE;
   
   switch($operator) 
   {
    case "==": 
			if($value1 == $value2) 
			   $result = TRUE;
			break;
    case "!=": if($value1 != $value2) 
			  $result = TRUE;
			break;
    case "GT": if($value1 > $value2) 
			  $result = TRUE;
			break;
    case "GE": if($value1 >= $value2) 
			  $result = TRUE;
			break;
    case "LT": if($value1 < $value2) 
			  $result = TRUE;
			break;
    case "LE": if($value1 <= $value2) 
			 $result = TRUE;
			break;
   }	// SWITCH
   return $result;
 }

 // Determina si el valor insertado por el usuario es correcto.
function Evaluation($id, $value, $input, $exercise_id, $operatorData, $answer) 
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
	// retrieve elements from de conditional 
   $cont=0;
   
   foreach ($data as $element) 
   {
    if($element[0] == 'v')
    { 
	 $trimmed = intval(ltrim($element, "v"));
     $value[$cont] = strval($input[$trimmed]);
    }	
    elseif($element[0] == 'a')
    { 
	$trimmed = intval(ltrim($element, "a"));
    $value[$cont] = strval($answer[$trimmed-1]);
    }	
    else
    { 
    $value[$cont] = strval($element);
    }
	
	//if($value[$cont] == "==")
	//  return "ccc";
	
	$cont++;
   }  

   // evaluate one or two conditional statements
   if($cont <= 3)
   {	  
	if(condicional($value[0],$data[1],$value[2]))
	{
		return $xml->input[$id]->option[$i]->result;
		$i=$count_options;
	}
   }
   else if($data[3] == "and")
   {
	if(condicional($value[0],$data[1],$value[2]) and condicional($value[4],$data[5],$value[6]))
	{
    	return $xml->input[$id]->option[$i]->result;
		$i=$count_options;
	}  
   }
   else if($data[3] == "or")
   {
	if(condicional($value[0],$data[1],$value[2]) or condicional($value[4],$data[5],$value[6]) )
	{
    	return $xml->input[$id]->option[$i]->result;
		$i=$count_options;
	}  
   }	   

   /*
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
   */
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
		elseif($element[0] == 'v')
		{ 
		 $trimmed = intval(ltrim($element, "v"));
         $equation .= $input[$trimmed];
		}	
		elseif($element[0] == 'a')
		{ 
		 $trimmed = intval(ltrim($element, "a"));
         $equation .= $answer[$trimmed-1];
		}	
		else
		{ 
		 $equation .= $element;
		}
/*		
		elseif (strpos($element,'v') === False)
		{ 
		 $equation .= $element;
		}
		else
		{ 
		 $trimmed = intval(ltrim($element, "v"));
         $equation .= $input[$trimmed];
		}		 
*/
	  }
   }
//	return $equation[3];
//	  $equation = "mcm(2,4)";

  if(strstr($equation,"mcm"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = mcm(intval($valor[0]), intval($valor[1]));
  }
  elseif(strstr($equation,"smn"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = smn(intval($valor[0]), intval($valor[1]));
  }
  elseif(strstr($equation,"smd"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = smd(intval($valor[0]), intval($valor[1]));
  }
  elseif(strstr($equation,"cod"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = cod(intval($valor[0]), intval($valor[1]));
  }
  elseif(strstr($equation,"red"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = red(intval($valor[0]), intval($valor[1]));
  }
  elseif(strstr($equation,"txt"))
  { 
	 $valor = explode(",", substr($equation,3));
	 $equation_result = txt($valor[0], $valor[1]);
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
 $answer[$cont] = $valor->value;
 if($valor->value == "")
	$valor->resp = 'neutro';
 else
 {
   $hint=Evaluation($cont, $valor->value, $data, $exercise_id, $operatorData, $answer);
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

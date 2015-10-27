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
 
 // Generate equation
 function genEquation($equation, $input, $answer) {
   $data   = explode(" ", $equation);
   $equation   = "";
   $operatorDT = "";
   
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
	  }
   }
   return $equation;
 } 

// Evaluate conditional statement
 function evalStatement($data, $input, $answer) {

     $m = new EvalMath;
	 $ops = array("==", "!=", "GE", "LE", "GT", "LT");
	   
	 $numStatement = 0;
	 $numOperator  = 0;
	 $statement1   = "";
	 $statement2   = "";
	 
	 for($j=0; $j<= count($data)-1; $j++)
	 {
		if (in_array($data[$j], $ops))		
		{	$numStatement++;
			$numOperator  = array_search($data[$j], $ops);
	    }
		else		
		{
		  if($numStatement == 0)
		    $statement1 .= $data[$j] . " ";
		  else
		    $statement2 .= $data[$j] . " ";
		}
	 }
	 	 
	 $equation = genEquation($statement1, $input, $answer);
	 $value1 = $m->evaluate($equation);
	 if($value1 == "")
		$value1 = $equation;
	 $equation = genEquation($statement2, $input, $answer);
	 $value2 = $m->evaluate($equation);
	 if($value2 == "")
		$value2 = $equation;

	 if(condicional($value1,$ops[$numOperator],$value2))
		return TRUE;
	 else
		return FALSE;
 }
 
 
 // Determina si el valor insertado por el usuario es correcto.
function Evaluation($id, $value, $input, $exercise_id, $operatorData, $answer) 
{
 $m = new EvalMath;

 $xml=simplexml_load_file($exercise_id) or die("Error: Cannot create object");
 
 // $ops = array("==", "!=", "GE", "LE", "GT", "LT");
 
 $count_options = $xml->input[$id]->count();
 for ($i = 0; $i < $count_options; $i++) 
 {
  $operator = $xml->input[$id]->option[$i]->operator;
  $equation = trim($xml->input[$id]->option[$i]->equation);
  $data = explode(" ", $equation);
  
  $operatorDT = "";
  
  if($operator == 'IF')
  {
	if(strstr($equation,"and"))
	{ 
	 $content = explode("and", $equation);
	 $data1   = explode(" ", $content[0]);
	 $data2   = explode(" ", $content[1]);

	 if(evalStatement($data1, $input, $answer) and evalStatement($data2, $input, $answer))
		 return $xml->input[$id]->option[$i]->result;
	}
	elseif(strstr($equation,"or"))
	{    
	 $content = explode("or", $equation);
	 $data1   = explode(" ", $content[0]);
	 $data2   = explode(" ", $content[1]);
	 
	 if(evalStatement($data1, $input, $answer) or evalStatement($data2, $input, $answer))
		 return $xml->input[$id]->option[$i]->result;

	}
	else
	{
	 if(evalStatement($data, $input, $answer))
		 return $xml->input[$id]->option[$i]->result;
	}
  }
  else
  {
   $equation   = "";
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
	  }
   }

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

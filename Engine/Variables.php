<?php
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$exercise_id = "../" . $_GET['exercise'] . ".xml";
$exercise_num = intval($_GET['num_exe']);

$xml=simplexml_load_file($exercise_id) or die("Error: Cannot create object");

//$count_exercises = $xml->count();
//$exercise = mt_rand(0,$count_exercises-1);

$data = explode(" ", $xml->exercise[$exercise_num]['data']);

$cont=0;

foreach ($request->result as &$valor) {
   $valor->value = $data[$cont];
   $cont++;
}
print_r(json_encode($request->result));
?>

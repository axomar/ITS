<?php //Ejemplo aprenderaprogramar.com, archivo escribir.php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$request->result;
$file = fopen("algo.html", "ww");
fwrite($file, "
<link rel='stylesheet' type='text/css' href='css/style.css'>
<script src='mathscribe/jquery-1.4.3.min.js'></script>
<script src='mathscribe/jqmath-etc-0.4.2.min.js'></script>
<script src='js/angular.min.js'></script>
<script src='js/ejercicios.js'></script>
<html ng-app='lordAngeloApp'>
		
<body ng-app='angularjs-starter' ng-controller='MainCtrl' >
    <h1>Resuelve el siguiente ejercicio</h1>
     <div class='container'>
		<div class='tabla'>
			<div class='renglon'>
				<div class='columna'  style='width: 500px; text-align: right;' >
    " . PHP_EOL);
//fwrite($file, "Variables={{questions}}" . PHP_EOL);
fwrite($file, $request->result . PHP_EOL);
//fwrite($file, "Respuestas= {{choices}}<div data-ng-init='setVariables()'></div></body></html>" . PHP_EOL);
fwrite($file, "
				</div>				
				<div class='columna' style='width: 800px; text-align: center;'>
					<input type=image id='feedback' src='Help.png'>
					<div data-ng-init='setVariables()'></div> <br>
					<div id='help'  data-ng-repeat='choice in choices' style='display:none;'>
					  <p align='center'><b><u> Da click en la celda en la que necesites ayuda </u></b></p>
					  <div id='help2'  data-ng-repeat='advise in choice.ayuda' ng-include='setNumFeedback($index)'> </div>
					  {{choices[focus].ayuda[valor]}} <br><br>
					  <a href='#' ng-click='Previous()'> << Previo </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href='#' ng-click='Next()'> Siguiente >> </a>		
					</div>
				</div> 
			</div>
		</div>
	</div>
</body>
</html>" . PHP_EOL);
fclose($file);
echo $request->result;
?>


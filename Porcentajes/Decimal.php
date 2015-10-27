<link rel='stylesheet' href='../Engine/mathscribe/jqmath-0.4.0.css'>
<link rel='stylesheet' type='text/css' href='../Engine/css/style.css'>
<script src='../Engine/mathscribe/jquery-1.4.3.min.js'></script>
<script src='../Engine/mathscribe/jqmath-etc-0.4.2.min.js'></script>
<script src='../Engine/js/angular.min.js'></script>
<script src='../Engine/js/ejercicios2.js'></script>

<?php
//// Captura datos enviados por URL /////////////////////////////
$user_id    = $_GET['user_id']; 	
$course_id  = $_GET['course_id']; 	
$cont_eje   = $_GET['cont_eje'];
$cidReq     = $_GET['cidReq'];

//// Define número de ejercicio ////////////////////////////////
$num_eje	= rand(0,49);
?>

<script language = javascript>
var id     	= "<? print $user_id; ?>";
var course_id 	= "<? print $course_id; ?>";
var cidReq 	= "<? print $cidReq; ?>";
var cont_eje 	= +"<? print $cont_eje; ?>";
var num_eje 	= "<? print $num_eje; ?>";
var file_path	= "Porcentajes/Decimal";
</script>

<html ng-app='lordAngeloApp'>
		
<body ng-app='angularjs-starter' ng-controller='MainCtrl' >
    <h1>Resuelve el siguiente ejercicio</h1>
	<h2 align=left>Representa el siguiente porcentaje en formato decimal: </h2>
     <div class='container'>
		<div class='tabla'>
			<div class='renglon'>
				<div class='columna'  style='width: 500px; text-align: right;' name='ejercicio'>	
				
    
    
<fmath alttext="% \html'

<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[0].resp&quot; 
id=&quot;0&quot; ng-model=&quot;questions[0].value&quot; name=&quot;name0&quot; ng-value=&quot;questions[0].value&quot; 
ng-init=&quot;questions[0].value=0&quot; disabled size=1>' = \html'

<input type=tetxt ng-class=&quot;choices[0].resp&quot; ng-blur=&quot;getSolutions('0')&quot; ng-focus=&quot;setFocus('0')&quot; id=&quot;0&quot; 
ng-model=&quot;choices[0].value&quot; name=&quot;name0&quot; ng-checked=&quot;choices[0].value&quot; ng-value=&quot;choices[0].value&quot; 
ng-init=&quot;choices[0].value=null&quot;  size=1>'" display="block" class="ma-block"><mrow><mrow><mtext>

<input type="text" value="0" style="border:0px;background-color:transparent;text-align:right; font-size:30px;" ng-class="questions[0].resp" id="0" 
ng-model="questions[0].value" name="name0" ng-value="questions[0].value" ng-init="questions[0].value=0" disabled="" size="1" 
class="ng-pristine ng-untouched ng-valid"></mtext></mrow><mo class="fm-infix-loose" style="padding-right: 0.44ex; font-size: 2.05em;">% =</mo><mtext>

<input type="tetxt" autofocus tabindex="2" style="font-size:30px; text-align:right;" ng-class="choices[0].resp" ng-blur="getSolutions('0')" 
ng-focus="setFocus('0')" id="0" ng-model="choices[0].value" name="name0" ng-checked="choices[0].value" ng-value="choices[0].value" 
ng-init="choices[0].value=null" size="1" class="ng-pristine ng-untouched ng-valid">
</mtext></mrow></fmath>

<br><br>

					<!-- div id="focusguard" tabindex="3" ng-focus="setFocus('0')"></div><br><br -->
					<div id="help"  data-ng-repeat="choice in choices" style="display:none; align:center;">
					  <p align="center"><b><u> Da clic en la celda de la que necesites ayuda </u></b></p>
					  <div id="help2"  data-ng-repeat="advise in choice" ng-include="setNumFeedback($index)"> </div>
					  <center><p style="color:green; font-size:150%"> {{choices[focus].ayuda[valor]}} </p></center><br><br>
					  <!-- a href="#" ng-click="Previous()"> << Previo </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="#/" ng-click="Next()"> Siguiente >> </a -->	
					</div>
					
				</div>				
				<div class='columna' style='width: 800px; text-align: center;'>
					<input type=image id="feedback" tabindex="3" src="../Engine/Help1.png" ng-click="logData('?')" 
					ng-focus="setFocus('0')" onFocus="this.tabIndex=1; this.src='../Engine/Help2.png'; blur();"
					onBlur="this.tabIndex=3; this.src='../Engine/Help1.png'"><br><br>
					
					<iframe src="http://lcc.ens.uabc.mx/~its/Herramientas/Calculadora.html" height=200 width=300></iframe>
					<!-- textarea name="textarea" rows="3" cols="40">Notas</textarea -->
					
					<script>document.write('<div data-ng-init="setVariables(\'Porcentajes/PDE\', ' + num_eje + ')"></div>');</script>					
					
				</div> 
			</div>
		</div>
	</div>
	
	<!-- strong>
 Variables &nbsp;&nbsp;&nbsp; = {{questions}} <br><br>
 Respuestas = {{choices}}  <br><br>
 Help = {{logging}}
</strong -->
	
	<div style="background:#F9EECF;">
		<br>
		<script>
			if(cont_eje <=3)
			{
				document.write('<div align="right"><center><b>Ejercicio [</b>' 
				+ cont_eje + ' de 3<b>]</b><br><a href = "../Engine/log/Logging.php?user_id=' 
				+ id + '&course_id=' + course_id + '&cont_eje=' + cont_eje + '&file_path=' + file_path + '&cidReq=' + cidReq
				+ ' " ng-click="saveLog(' + id + ',\'' + course_id + '\',' + num_eje + ',' + cont_eje + ',' + cidReq
				+ ')">Siguiente Ejercicio</a></center><br><br></div>');
			}
			else
			{
				document.write('<div align="right"><center><b>Ejercicio [</b>' 
				+ cont_eje + ' de 3<b>]</b><br><a href = "../Engine/log/Logging.php?user_id=' 
				+ id + '&course_id=' + course_id + '&cont_eje=' + cont_eje 
				+ ' " ng-click="saveLog(' + id + ',\'' + course_id + '\',' + num_eje + ',' + cont_eje + ',' + cidReq +')'				
				+ '" onClik = "javascript:alert(\'Muy Bien! Has concluido tus preguntas de Exponentes\'); ">Men' 
				+ '\u00fa' +' Anterior</a></center><br><br></div>');
			}
		</script>
	</div>
	
</body>
</html>
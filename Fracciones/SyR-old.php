
<link rel='stylesheet' href='../Engine/mathscribe/jqmath-0.4.0.css'>
<link rel='stylesheet' type='text/css' href='../Engine/css/style.css'>
<script src='../Engine/mathscribe/jquery-1.4.3.min.js'></script>
<script src='../Engine/mathscribe/jqmath-etc-0.4.2.min.js'></script>
<script src='../Engine/js/angular.min.js'></script>
<script src='../Engine/js/ejercicios.js'></script>

<?php
//// Captura datos enviados por URL /////////////////////////////
$user_id    = $_GET['user_id']; 	
$course_id  = $_GET['course_id']; 	
$cont_eje   = $_GET['cont_eje'];

//// Define número de ejercicio ////////////////////////////////
$num_eje	= rand(1,50);
?>

<script language = javascript>
var id     	= "<? print $user_id; ?>";
var cidReq 	= "<? print $course_id; ?>";
var cont_eje 	= +"<? print $cont_eje; ?>";
var num_eje 	= "<? print $num_eje; ?>";
var file_path	= "Fracciones/SyR";
</script>

<html ng-app='lordAngeloApp'>
		
<body ng-app='angularjs-starter' ng-controller='MainCtrl' >
    <h1>Resuelve el siguiente ejercicio</h1>
	<h2 align=left>Convierte el siguiente número en notación estándar a notación científica: </h2>
     <div class='container'>
		<div class='tabla'>
			<div class='renglon'>
				<div class='columna'  style='width: 500px; text-align: right;' name='ejercicio'>	
				
<fmath alttext="(\html'<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[0].resp&quot; id=&quot;0&quot; ng-model=&quot;questions[0].value&quot; name=&quot;name0&quot; ng-value=&quot;questions[0].value&quot; ng-init=&quot;questions[0].value=0&quot; disabled   size=1>' / \html'<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[1].resp&quot; id=&quot;1&quot; ng-model=&quot;questions[1].value&quot; name=&quot;name1&quot; ng-value=&quot;questions[1].value&quot; ng-init=&quot;questions[1].value=1&quot; disabled   size=1>') \html'<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[2].resp&quot; id=&quot;2&quot; ng-model=&quot;questions[2].value&quot; name=&quot;name2&quot; ng-value=&quot;questions[2].value&quot; ng-init=&quot;questions[2].value=2&quot; disabled   size=1>' (\html'<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[3].resp&quot; id=&quot;3&quot; ng-model=&quot;questions[3].value&quot; name=&quot;name3&quot; ng-value=&quot;questions[3].value&quot; ng-init=&quot;questions[3].value=3&quot; disabled   size=1>' / \html'<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[4].resp&quot; id=&quot;4&quot; ng-model=&quot;questions[4].value&quot; name=&quot;name4&quot; ng-value=&quot;questions[4].value&quot; ng-init=&quot;questions[4].value=4&quot; disabled   size=1>') = \html'<input type=tetxt ng-class=&quot;choices[0].resp&quot; ng-blur=&quot;getSolutions()&quot; ng-click=&quot;setFocus(0)&quot; id=&quot;0&quot; ng-model=&quot;choices[0].value&quot; name=&quot;name0&quot; ng-checked=&quot;choices[0].value&quot; ng-value=&quot;choices[0].value&quot; ng-init=&quot;choices[0].value=null&quot;  size=1>' \html'<select  ng-options=&quot;item for item in choices[2].values&quot;ng-class=&quot;choices[2].resp&quot; ng-blur=&quot;getSolutions()&quot; id=&quot;2&quot; ng-model=&quot;choices[2].value&quot; name=&quot;name2&quot; ng-checked=&quot;choices[2].value&quot; ng-value=&quot;choices[2].value&quot; ng-init=&quot;choices[2].value=null&quot; >' \html'<input type=tetxt ng-class=&quot;choices[1].resp&quot; ng-blur=&quot;getSolutions()&quot; ng-click=&quot;setFocus(1)&quot; id=&quot;1&quot; ng-model=&quot;choices[1].value&quot; name=&quot;name1&quot; ng-checked=&quot;choices[1].value&quot; ng-value=&quot;choices[1].value&quot; ng-init=&quot;choices[1].value=null&quot;  size=1>'" display="block" class="ma-block"><mrow><mrow><mrow><mrow><mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">(</mo><span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac"><table><tbody><tr><td class="fm-num-frac fm-inline"><mtext><input type="text" value="0" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[0].resp" id="0" ng-model="questions[0].value" name="name0" ng-value="questions[0].value" ng-init="questions[0].value=0" disabled="" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td></tr><tr><td class="fm-den-frac fm-inline"><mtext><input type="text" value="1" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[1].resp" id="1" ng-model="questions[1].value" name="name1" ng-value="questions[1].value" ng-init="questions[1].value=1" disabled="" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td></tr></tbody></table></span></span><mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">)</mo></mrow><mtext><input type="text" value="2" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[2].resp" id="2" ng-model="questions[2].value" name="name2" ng-value="questions[2].value" ng-init="questions[2].value=2" disabled="" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></mrow><mrow><mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">(</mo><span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac"><table><tbody><tr><td class="fm-num-frac fm-inline"><mtext><input type="text" value="3" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[3].resp" id="3" ng-model="questions[3].value" name="name3" ng-value="questions[3].value" ng-init="questions[3].value=3" disabled="" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td></tr><tr><td class="fm-den-frac fm-inline"><mtext><input type="text" value="4" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[4].resp" id="4" ng-model="questions[4].value" name="name4" ng-value="questions[4].value" ng-init="questions[4].value=4" disabled="" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td></tr></tbody></table></span></span><mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">)</mo></mrow></mrow><mo class="fm-infix-loose">=</mo><mrow><mrow><mtext><input type="tetxt" ng-class="choices[0].resp" ng-blur="getSolutions()" ng-click="setFocus(0)" id="0" ng-model="choices[0].value" name="name0" ng-checked="choices[0].value" ng-value="choices[0].value" ng-init="choices[0].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext><mtext><select ng-options="item for item in choices[2].values" ng-class="choices[2].resp" ng-blur="getSolutions()" id="2" ng-model="choices[2].value" name="name2" ng-checked="choices[2].value" ng-value="choices[2].value" ng-init="choices[2].value=null" class="ng-pristine ng-untouched ng-valid"><option value="" selected="selected" label=""></option><option value="0" label="uno">uno</option><option value="1" label="dos">dos</option></select></mtext></mrow><mtext><input type="tetxt" ng-class="choices[1].resp" ng-blur="getSolutions()" ng-click="setFocus(1)" id="1" ng-model="choices[1].value" name="name1" ng-checked="choices[1].value" ng-value="choices[1].value" ng-init="choices[1].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></mrow></mrow></fmath>


<br><br>

					<!-- div id="focusguard" tabindex="3" ng-focus="setFocus('0')"></div><br><br -->
					<div id="help"  data-ng-repeat="choice in choices" style="display:none; align:center;">
					  <p align="center"><b><u> Da clic en la celda de la que necesites ayuda </u></b></p>
					  <div id="help2"  data-ng-repeat="advise in choice" ng-include="setNumFeedback($index)"> </div>
					  <center> {{choices[focus].ayuda[valor]}} </center><br><br>
					  <!-- a href="#" ng-click="Previous()"> << Previo </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  <a href="#/" ng-click="Next()"> Siguiente >> </a -->	
					</div>
					
				</div>				
				<div class='columna' style='width: 800px; text-align: center;'>
					<input type=image id="feedback" tabindex="4" src="../Engine/Help1.png" ng-click="logData('?')" 
					ng-focus="setFocus('0')" onFocus="this.tabIndex=1; this.src='../Engine/Help2.png'; blur();"
					onBlur="this.tabIndex=4; this.src='../Engine/Help1.png'"><br><br>
					
					<iframe src="http://lcc.ens.uabc.mx/~its/Herramientas/Calculadora.html" height=200 width=300></iframe>
					<!-- textarea name="textarea" rows="3" cols="40">Notas</textarea -->
					
					<script>document.write('<div data-ng-init="setVariables(\'Fracciones/FSR\', ' + num_eje + ')"></div>');</script>					
					
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
				+ id + '&course_id=' + cidReq + '&cont_eje=' + cont_eje + '&file_path=' + file_path 
				+ ' " ng-click="saveLog(' + id + ',\'' + cidReq + '\',' + num_eje + ',' + cont_eje
				+ ')">Siguiente Ejercicio</a></center><br><br></div>');
			}
			else
			{
				document.write('<div align="right"><center><b>Ejercicio [</b>' 
				+ cont_eje + ' de 3<b>]</b><br><a href = "../Engine/log/Logging.php?user_id=' 
				+ id + '&course_id=' + cidReq + '&cont_eje=' + cont_eje 
				+ ' " ng-click="saveLog(' + id + ',\'' + cidReq + '\','  + num_eje + ',' + cont_eje +')'				
				+ '" onClik = "javascript:alert(\'Muy Bien! Has concluido tus preguntas de Exponentes\'); ">Men' 
				+ '\u00fa' +' Anterior</a></center><br><br></div>');
			}
		</script>
	</div>
	
</body>
</html>
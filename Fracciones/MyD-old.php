
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
var id     	    = "<? print $user_id; ?>";
var course_id 	= "<? print $course_id; ?>";
var cidReq 	    = "<? print $cidReq; ?>";
var cont_eje 	= +"<? print $cont_eje; ?>";
var num_eje 	= "<? print $num_eje; ?>";
var file_path	= "Fracciones/MyD";
</script>

<html ng-app='lordAngeloApp'>
		
<body ng-app='angularjs-starter' ng-controller='MainCtrl' >
    <h1>Resuelve el siguiente ejercicio</h1>
	<h2 align=left>Resuelve la siguiente poeración entre fracciones: </h2>
     <div class='container'>
		<div class='tabla'>
			<div class='renglon'>
				<div class='columna'  style='width: 500px; text-align: right;' name='ejercicio'>			

    
<fmath alttext="(\html'
<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[0].resp&quot; id=&quot;0&quot; 
ng-model=&quot;questions[0].value&quot; name=&quot;name0&quot; ng-value=&quot;questions[0].value&quot; ng-init=&quot;questions[0].value=0&quot; disabled   
size=1>' / \html'

<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[1].resp&quot; id=&quot;1&quot; 
ng-model=&quot;questions[1].value&quot; name=&quot;name1&quot; ng-value=&quot;questions[1].value&quot; ng-init=&quot;questions[1].value=1&quot; disabled   
size=1>') \html'

<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[2].resp&quot; id=&quot;2&quot; 
ng-model=&quot;questions[2].value&quot; name=&quot;name2&quot; ng-value=&quot;questions[2].value&quot; ng-init=&quot;questions[2].value=2&quot; disabled   
size=1>' (\html'

<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[3].resp&quot; id=&quot;3&quot; 
ng-model=&quot;questions[3].value&quot; name=&quot;name3&quot; ng-value=&quot;questions[3].value&quot; ng-init=&quot;questions[3].value=3&quot; disabled   
size=1>' / \html'

<input type=text value =5 style=border:0px;background-color:transparent;text-align:center;  ng-class=&quot;questions[4].resp&quot; id=&quot;4&quot; 
ng-model=&quot;questions[4].value&quot; name=&quot;name4&quot; ng-value=&quot;questions[4].value&quot; ng-init=&quot;questions[4].value=4&quot; disabled   
size=1>') = ( \html'

<input type=tetxt ng-class=&quot;choices[0].resp&quot; ng-blur=&quot;getSolutions('0')&quot; ng-focus=&quot;setFocus('0')&quot; id=&quot;0&quot; 
ng-model=&quot;choices[0].value&quot; name=&quot;name0&quot; ng-checked=&quot;choices[0].value&quot; ng-value=&quot;choices[0].value&quot; 
ng-init=&quot;choices[0].value=null&quot;  size=1>' \html'

<input type=tetxt ng-class=&quot;choices[1].resp&quot; ng-blur=&quot;getSolutions('1')&quot; ng-focus=&quot;setFocus('1')&quot; id=&quot;1&quot; 
ng-model=&quot;choices[1].value&quot; name=&quot;name1&quot; ng-checked=&quot;choices[1].value&quot; ng-value=&quot;choices[1].value&quot; 
ng-init=&quot;choices[1].value=null&quot;  size=1>' \html'

<input type=tetxt ng-class=&quot;choices[2].resp&quot; ng-blur=&quot;getSolutions('2')&quot; ng-focus=&quot;setFocus('2')&quot; id=&quot;2&quot; 
ng-model=&quot;choices[2].value&quot; name=&quot;name2&quot; ng-checked=&quot;choices[2].value&quot; ng-value=&quot;choices[2].value&quot; 
ng-init=&quot;choices[2].value=null&quot;  size=1>' ) / \html'

<input type=tetxt ng-class=&quot;choices[3].resp&quot; ng-blur=&quot;getSolutions('3')&quot; ng-focus=&quot;setFocus('3')&quot; id=&quot;3&quot; 
ng-model=&quot;choices[3].value&quot; name=&quot;name3&quot; ng-checked=&quot;choices[3].value&quot; ng-value=&quot;choices[3].value&quot; 
ng-init=&quot;choices[3].value=null&quot;  size=1>' = \html'

<input type=tetxt ng-class=&quot;choices[4].resp&quot; ng-blur=&quot;getSolutions('4')&quot; ng-focus=&quot;setFocus('4')&quot; id=&quot;4&quot; 
ng-model=&quot;choices[4].value&quot; name=&quot;name4&quot; ng-checked=&quot;choices[4].value&quot; ng-value=&quot;choices[4].value&quot; 
ng-init=&quot;choices[4].value=null&quot;  size=1>' / \html'

<input type=tetxt ng-class=&quot;choices[5].resp&quot; ng-blur=&quot;getSolutions('5')&quot; ng-focus=&quot;setFocus('5')&quot; id=&quot;5&quot; 
ng-model=&quot;choices[5].value&quot; name=&quot;name5&quot; ng-checked=&quot;choices[5].value&quot; ng-value=&quot;choices[5].value&quot; 
ng-init=&quot;choices[5].value=null&quot;  size=1>' = \html'

<input type=tetxt ng-class=&quot;choices[6].resp&quot; ng-blur=&quot;getSolutions('6')&quot; ng-focus=&quot;setFocus('6')&quot; id=&quot;6&quot; 
ng-model=&quot;choices[6].value&quot; name=&quot;name6&quot; ng-checked=&quot;choices[6].value&quot; ng-value=&quot;choices[6].value&quot; 
ng-init=&quot;choices[6].value=null&quot;  size=1>' / \html'

<input type=tetxt ng-class=&quot;choices[7].resp&quot; ng-blur=&quot;getSolutions('7')&quot; ng-focus=&quot;setFocus('7')&quot; id=&quot;7&quot; 
ng-model=&quot;choices[7].value&quot; name=&quot;name7&quot; ng-checked=&quot;choices[7].value&quot; ng-value=&quot;choices[7].value&quot; 
ng-init=&quot;choices[7].value=null&quot;  size=1>' =  \html'

<input type=tetxt ng-class=&quot;choices[8].resp&quot; ng-blur=&quot;getSolutions('8')&quot; ng-focus=&quot;setFocus('8')&quot; id=&quot;8&quot; 
ng-model=&quot;choices[8].value&quot; name=&quot;name8&quot; ng-checked=&quot;choices[8].value&quot; ng-value=&quot;choices[8].value&quot; 
ng-init=&quot;choices[8].value=null&quot;  size=1>' ( \html'

<input type=tetxt ng-class=&quot;choices[9].resp&quot; ng-blur=&quot;getSolutions('9')&quot; ng-focus=&quot;setFocus('9')&quot; id=&quot;9&quot; 
ng-model=&quot;choices[9].value&quot; name=&quot;name9&quot; ng-checked=&quot;choices[9].value&quot; ng-value=&quot;choices[9].value&quot; 
ng-init=&quot;choices[9].value=null&quot;  size=1>' / \html'

<input type=tetxt ng-class=&quot;choices[10].resp&quot; ng-blur=&quot;getSolutions('10')&quot; ng-focus=&quot;setFocus('10')&quot; id=&quot;10&quot; 
ng-model=&quot;choices[10].value&quot; name=&quot;name10&quot; ng-checked=&quot;choices[10].value&quot; ng-value=&quot;choices[10].value&quot; 
ng-init=&quot;choices[10].value=null&quot;  size=1>' )" display="block" class="ma-block"><mrow><mrow><mrow><mrow><mrow><mrow><mrow>
<mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">(</mo>
<span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac"><table><tbody><tr><td class="fm-num-frac fm-inline"><mtext>

<input type="text" value="0" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[0].resp" id="0" 
ng-model="questions[0].value" name="name0" ng-value="questions[0].value" ng-init="questions[0].value=0" disabled="" size="1" class="ng-pristine 
ng-untouched ng-valid"></mtext></td></tr><tr><td class="fm-den-frac fm-inline"><mtext>

<input type="text" value="1" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[1].resp" id="1" 
ng-model="questions[1].value" name="name1" ng-value="questions[1].value" ng-init="questions[1].value=1" disabled="" size="1" 
class="ng-pristine ng-untouched ng-valid"></mtext></td></tr></tbody></table></span></span>
<mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">)</mo></mrow><mtext>

<input type="text" value="2" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[2].resp" id="2" 
ng-model="questions[2].value" name="name2" ng-value="questions[2].value" ng-init="questions[2].value=2" disabled="" size="1" 
class="ng-pristine ng-untouched ng-valid"></mtext></mrow><mrow><mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: 
inline-block; transform: scaleX(0.5);">(</mo><span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac"><table><tbody><tr>
<td class="fm-num-frac fm-inline"><mtext>

<input type="text" value="3" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[3].resp" id="3" 
ng-model="questions[3].value" name="name3" ng-value="questions[3].value" ng-init="questions[3].value=3" disabled="" size="1" 
class="ng-pristine ng-untouched ng-valid"></mtext></td></tr><tr><td class="fm-den-frac fm-inline"><mtext>

<input type="text" value="4" style="border:0px;background-color:transparent;text-align:center;" ng-class="questions[4].resp" id="4" 
ng-model="questions[4].value" name="name4" ng-value="questions[4].value" ng-init="questions[4].value=4" disabled="" size="1" 
class="ng-pristine ng-untouched ng-valid"></mtext></td></tr></tbody></table></span></span><mo class="fm-mo-Luc" style="font-size: 2.05em; 
vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">)</mo></mrow></mrow><mo class="fm-infix-loose">=</mo>
<span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac"><table><tbody><tr><td class="fm-num-frac fm-inline"><mrow>
<mo class="fm-mo-Luc">(</mo><mrow><mrow><mtext>

<input type="tetxt" autofocus tabindex="2" ng-class="choices[0].resp" ng-blur="getSolutions('0')" ng-focus="setFocus('0')" id="0" ng-model="choices[0].value" 
name="name0" ng-checked="choices[0].value" ng-value="choices[0].value" ng-init="choices[0].value=null" size="1" class="ng-pristine ng-untouched ng-valid">
</mtext><mtext>

<input type="tetxt" tabindex="3" ng-class="choices[1].resp" ng-blur="getSolutions('1')" ng-focus="setFocus('1')" id="1" ng-model="choices[1].value" 
name="name1" ng-checked="choices[1].value" ng-value="choices[1].value" ng-init="choices[1].value=null" size="1" class="ng-pristine ng-untouched ng-valid">
</mtext></mrow><mtext>

<input type="tetxt" tabindex="4" ng-class="choices[2].resp" ng-blur="getSolutions('2')" ng-focus="setFocus('2')" id="2" ng-model="choices[2].value" name="name2" 
ng-checked="choices[2].value" ng-value="choices[2].value" ng-init="choices[2].value=null" size="1" class="ng-pristine ng-untouched ng-valid">
</mtext></mrow><mo class="fm-mo-Luc">)</mo></mrow></td></tr><tr><td class="fm-den-frac fm-inline"><mtext>

<input type="tetxt" tabindex="5" ng-class="choices[3].resp" ng-blur="getSolutions('3')" ng-focus="setFocus('3')" id="3" ng-model="choices[3].value" name="name3" 
ng-checked="choices[3].value" ng-value="choices[3].value" ng-init="choices[3].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr></tbody></table></span></span></mrow><mo class="fm-infix-loose">=</mo><span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac">
<table><tbody><tr><td class="fm-num-frac fm-inline"><mtext>

<input type="tetxt" tabindex="6" ng-class="choices[4].resp" ng-blur="getSolutions('4')" ng-focus="setFocus('4')" id="4" ng-model="choices[4].value" name="name4" 
ng-checked="choices[4].value" ng-value="choices[4].value" ng-init="choices[4].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr><tr><td class="fm-den-frac fm-inline"><mtext>

<input type="tetxt" tabindex="7" ng-class="choices[5].resp" ng-blur="getSolutions('5')" ng-focus="setFocus('5')" id="5" ng-model="choices[5].value" name="name5" 
ng-checked="choices[5].value" ng-value="choices[5].value" ng-init="choices[5].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr></tbody></table></span></span></mrow><mo class="fm-infix-loose">=</mo><span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac">
<table><tbody><tr><td class="fm-num-frac fm-inline"><mtext>

<input type="tetxt" tabindex="8" ng-class="choices[6].resp" ng-blur="getSolutions('6')" ng-focus="setFocus('6')" id="6" ng-model="choices[6].value" name="name6" 
ng-checked="choices[6].value" ng-value="choices[6].value" ng-init="choices[6].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr><tr><td class="fm-den-frac fm-inline"><mtext>

<input type="tetxt" tabindex="9" ng-class="choices[7].resp" ng-blur="getSolutions('7')" ng-focus="setFocus('7')" id="7" ng-model="choices[7].value" name="name7" 
ng-checked="choices[7].value" ng-value="choices[7].value" ng-init="choices[7].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr></tbody></table></span></span></mrow><mo class="fm-infix-loose">=</mo><mrow><mtext>

<input type="tetxt" tabindex="10" ng-class="choices[8].resp" ng-blur="getSolutions('8')" ng-focus="setFocus('8')" id="8" ng-model="choices[8].value" name="name8" 
ng-checked="choices[8].value" ng-value="choices[8].value" ng-init="choices[8].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext><mrow>
<mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">(</mo>
<span mtagname="mfrac" style="vertical-align: 0em;"><span class="fm-vert fm-frac"><table><tbody><tr><td class="fm-num-frac fm-inline"><mtext>

<input type="tetxt" tabindex="11" ng-class="choices[9].resp" ng-blur="getSolutions('9')" ng-focus="setFocus('9')" id="9" ng-model="choices[9].value" name="name9" 
ng-checked="choices[9].value" ng-value="choices[9].value" ng-init="choices[9].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr><tr><td class="fm-den-frac fm-inline"><mtext>

<input type="tetxt" tabindex="12" ng-class="choices[10].resp" ng-blur="getSolutions('10')" ng-focus="setFocus('10')" id="10" ng-model="choices[10].value" name="name10" 
ng-checked="choices[10].value" ng-value="choices[10].value" ng-init="choices[10].value=null" size="1" class="ng-pristine ng-untouched ng-valid"></mtext></td>
</tr></tbody></table></span></span><mo class="fm-mo-Luc" style="font-size: 2.05em; vertical-align: -0.128em; display: inline-block; transform: scaleX(0.5);">)
</mo></mrow></mrow></mrow></fmath>


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
					<input type=image id="feedback" tabindex="13" src="../Engine/Help1.png" ng-click="logData('?')" 
					ng-focus="setFocus('0')" onFocus="this.tabIndex=1; this.src='../Engine/Help2.png'; blur();"
					onBlur="this.tabIndex=10; this.src='../Engine/Help1.png'"><br><br>
					
					<iframe src="http://lcc.ens.uabc.mx/~its/Herramientas/Calculadora.html" height=200 width=300></iframe>
					<!-- textarea name="textarea" rows="3" cols="40">Notas</textarea -->
					
					<script>document.write('<div data-ng-init="setVariables(\'Fracciones/FMD\', ' + num_eje + ')"></div>');</script>					
					
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

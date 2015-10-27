<?php
/* For licensing terms, see /license.txt */
/**

P�gina adaptada para el despliegue de estad�sticas del ITS generadas por el .log file

*	This is the tracking library for Chamilo.
*
*	@package chamilo.reporting
*
* Calculates the time spent on the course
* @param integer $user_id the user id
* @param string $course_code the course code
* @author Julio Montoya <gugli100@gmail.com>
* @author Jorge Frisancho Jibaja - select between dates
* 
*/
/**
 * Code
 */
// name of the language file that needs to be included
$language_file = array ('registration', 'index', 'tracking');

require_once '../inc/global.inc.php';

// the section (for the tabs)
$this_section = SECTION_TRACKING;

/* MAIN */

/*echo "<script>alert('Fecha 1: ' + 10+ ' Fecha 2: ' +".$fecha2.");</script>";
*/
$quote_simple = "'";

$htmlHeadXtra[] = '<script src="slider.js" type="text/javascript"></script>';
$htmlHeadXtra[] = '<link rel="stylesheet" href="slider.css" />';


/*
$htmlHeadXtra[] = '<script type="text/javascript">

function changeHREF(sd,ed) {
    var i       = 0;
    var href    = "";
    var href1   = "";
    $('.$quote_simple .'#container-9 a'.$quote_simple .').each(function() {
        href = $.data(this, '.$quote_simple .'href.tabs'.$quote_simple .');
        href1= href+"&sd="+sd+"&ed="+ed+"&range=1";
        $("#container-9").tabs("url", i, href1);
        var href1 = $.data(this, '.$quote_simple .'href.tabs'.$quote_simple .');
        i++
    })
}

function runEffect(){
    //most effect types need no options passed by default
    var options = {};
     //run the effect
    $("#cev_button").show('.$quote_simple .'slide'.$quote_simple .',options,500,cev_effect());
}

//callback function to bring a hidden box back
function cev_effect(){
    setTimeout(function(){
        $("#cev_button:visible").removeAttr('.$quote_simple .'style'.$quote_simple .').hide().fadeOut();
    }, 1000);
}

function areBothFilled() {
        var returnValue = false;
        if ((document.getElementById("date_from").value != "") && (document.getElementById("date_to").value != "")){
            returnValue = true;
        }
        return returnValue;
}
</script>';

$htmlHeadXtra[] = '<script type="text/javascript">
$(function() {
        $("#cev_button").hide();
        $("#container-9").tabs({remote: true});
});
</script>';*/

$htmlHeadXtra[]='
  <script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
  </script>

	';
	


//Changes END
$interbreadcrumb[] = array ('url' => '#', 'name' => get_lang('AccessDetails'));

Display :: display_header('');
echo Display::page_header('Desempeño Curso');
echo Display::page_subheader('Estadisticas generales');
?>
    <div>
    <table width="300">
    	<FORM name="formulario" action="javascript:path()">
       		<tr height="2%">
                <!-- td height="2%" align = "right"><span class="Filtro">De:</span></td>
            	<td height="2%" align="center"><INPUT TYPE="text" NAME="date1" class = "datepicker" id="fecha_1" /><br /></td -->
				<td height="2%" align="center"><INPUT TYPE="hidden" NAME="date1" class = "datepicker" id="fecha_1" /><br /></td>
            </tr>
            <tr height="2%">
            	<!-- td height="2%" align = "right"><span class="Filtro">Hasta:</span></td>
            	<td height="2%" align="center"><INPUT TYPE="text" NAME="date2" class = "datepicker" id="fecha_2" /></td -->
				<td height="2%" align="center"><INPUT TYPE="hidden" NAME="date2" class = "datepicker" id="fecha_2" /></td>
            </tr>
            <p>
            	<tr><td></td><td align="center">
                	<input hidden type="submit" value="Filtrar">
                </td></tr>
            </p>
        </FORM>  
      </table>
	</div>    
<style>


 
h2 {
    cursor: pointer;
    color: #696;
    font-weight:bold;
    background-image:url('http://idratherbewriting.com/wp-content/uploads/2013/03/plus3.jpg');
    background-repeat:no-repeat;
    text-indent:23px;
    background-position:4px 8px;
}
.open {
    background-image:url('http://idratherbewriting.com/wp-content/uploads/2013/03/minusb.jpg');
}
.Filtro {
	font-family: Arial, Helvetica, sans-serif;
}
</style>

<div id="cev_results_header" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
	
<div id="cev_results" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"><?php echo get_lang('Statistics'); ?></div><br />
    <div id="cev_cont_stats">
	

	
 <?php	
 
echo '<p> Estadisticas de curso: ' .$course_code. '</p>';
		
//// Conexi�n a la BD e inserci�n de datos /////////////////////
 
 $enlace =  mysql_connect('localhost','siec','siec2013');
 if (!$enlace) 
 {
	die('No pudo conectarse: ' . mysql_error());
 }

 mysql_select_db(siec) or die("Cannot select database!<br>" . mysql_error());


 $fecha1 = $_GET['fecha1'];
 $fecha2 = $_GET['fecha2'];
 $fechonga1 = date_parse($fecha1);
 $fechonga2 = date_parse($fecha2);
 $fecha_1_des = $fechonga1['year']."-".$fechonga1['month']."-".$fechonga1['day'];
 $fecha_2_des = $fechonga2['year']."-".$fechonga2['month']."-".$fechonga2['day'];
 
 if($fecha1=="" or $fecha2 == ""){
   $query  = "select date,count(date) from its_summary  where course = '".$course_code."' group by(date)";
 }
 else
 {
    $query  = "select date,count(date) from its_summary where course = '".$course_code."' and date >= '".$fecha_1_des."' and date <= '".$fecha_2_des."' group by(date)";
 }
 $result = mysql_query($query) or die (mysql_error());

 while($row = mysql_fetch_array($result)){	
 	$query_tiempo = "select sum(elapsed_time) from its_summary where course = '".$course_code."' and date='".$row['date']."'";
	$resTiempo = mysql_query($query_tiempo) or die (mysql_error());
 	$tiempo = mysql_fetch_array($resTiempo);
	$time3 = ($tiempo['sum(elapsed_time)']%60);
	$time2 = (($tiempo['sum(elapsed_time)']/60) - (($tiempo['sum(elapsed_time)']%60)/60))%60;
	$time1 = ($tiempo['sum(elapsed_time)']/3600);
	
	
	 echo "
	 <input style = 'display:none' value='http://lcc.ens.uabc.mx/~siec/chamilo/main/tracking/statistics_details_group.php' id ='URL_Hide' />
	 
		<table border=\"1\" id='tabla_rem'>
		<tr>
			<tr class = 'clickable' id ='t_".$row['date']."'>
				<td colspan=\"3\" width=\"5%\">
						Fecha: ".$row['date']."|   No. Ejercicios: ". $row['count(date)']."
					<a onclick='change(\"i_".$row['date']."\",\"t_".$row['date']."\")'><img src='../img/icons/22/zoom_in.png' id='i_".$row['date']."'></img></a>
				</td>
				<td colspan=\"3\" width=\"5%\" align='right'>Tiempo de uso por dia: 00:".$time2.":".$time3."</td>
			</tr>
				<tr>
						<td  width=\"5%\" align='center'> <b>Ejercicio:</b> </td>
						<td  width=\"5%\" align='center'> <b>No. de Alumnos:</b> </td>
						<td  width=\"5%\" align='center'> <b>Solicitud de Ayuda:</b> </td>
						<td  width=\"5%\" align='center'> <b>Numero de Errores:</b> </td>
						<td  width=\"5%\" align='center'> <b>Resultado:</b> </td>
						<td  width=\"5%\" align='center'> <b>Tiempo estimado:</b> </td>
				</tr>	
		";
	  $query1 = " select distinct(exercise_id),count(exercise_id),hints,errors,result,elapsed_time from its_summary where course = '".$course_code."' and date = '".$row['date']."' group by(exercise_id)";
	  
 	  $resultado = mysql_query($query1) or die (mysql_error());
	  while($brawl = mysql_fetch_array($resultado)){
		 echo "
				<tr>   
						<td width=\"5%\" >  ".$brawl['exercise_id']." </td>
						<td width=\"5%\" > ".$brawl['count(exercise_id)']." </td>
						<td width=\"5%\" > ".$brawl['hints']." </td>
						<td width=\"5%\" >  ".$brawl['errors']."</td>
						<td width=\"5%\" >  ".$brawl['result']."</td>
						<td width=\"5%\" align = 'right'>  "
						
						.($brawl['elapsed_time']).
						
						" &nbsp; segundos </td>
				</tr>
			";
	 }
		echo "
			</tr>
		</table>";
 }
 
 /////////////////////////////////////////////////////////////////
 ?>
 <script type="text/javascript" src="js/jquery-latest.js"></script>
 <script type="text/javascript">
 
function path(){
	var url = document.getElementById('URL_Hide').value;
	   url += '&fecha1='+document.getElementById('fecha_1').value
	   url += '&fecha2='+document.getElementById('fecha_2').value
	window.location.href = url;
}

function change(imagen,fila){
	var src = (document.getElementById(imagen).src)
	if(src == "http://lcc.ens.uabc.mx/~siec/chamilo/main/img/icons/22/zoom_in.png"){
		document.getElementById(imagen).src = "http://lcc.ens.uabc.mx/~siec/chamilo/main/img/icons/22/zoom_out.png";
	}
	else{
		document.getElementById(imagen).src = "http://lcc.ens.uabc.mx/~siec/chamilo/main/img/icons/22/zoom_in.png";
	}
	
	$(document.getElementById(fila)).nextUntil('tr.clickable').slideToggle();
	
}
			 	
function toggle(row) {
  if (isNaN(row)) row = document.getElementById(row); // id passed
  else row = document.getElementById('table1').rows[row]; // idx passed
  if (row) row.style.display=(row.style.display=='none')?'':'none';
  return false;
}
 
if (document.images) {
    img1 = new Image();
    img1.src = "http://idratherbewriting.com/wp-content/uploads/2013/03/plus3.jpg";
    img2 = new Image();
    img2.src = "http://idratherbewriting.com/wp-content/uploads/2013/03/minusb.jpg";
}

$(document).ready(function () {
	$(".clickable").nextUntil('tr.clickable').slideToggle();
	/*
	var src = ($('img').attr('src') === '../img/icons/22/zoom_out.png')
    	? '../img/icons/22/zoom_out.png'
        : '../img/icons/22/zoom_in.png';
    $('img').attr('src', src);	
	*/

	date1 = getParameter('fecha1');
    date2 = getParameter('fecha2');
	document.formulario.date1.value = date1;
	document.formulario.date2.value = date2;
	document.formulario.submit;
	
    $('.section').hide();
    $('h2').click(function () {
        $(this).toggleClass("open");
        $(this).next().toggle();
    }); //end toggle

    $('#expandall').click(function () {
        $('.section').show();
        $('h2').addClass("open");
    });

    $('#collapseall').click(function () {
        $('.section').hide();
        $('h2').removeClass("open");
    });

}); //end ready

$(function () {
    $('#contenedor').highcharts({
        data: {
            table: document.getElementById('tabla_estadisticas')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estadisticas de total de ejercicios por dia'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Numero de Ejercicios'
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.series.name +'</b><br/>'+
                    this.y +' '+ this.x.toLowerCase();
            }
        }
    });
});


$(function () {
    $('#contenedor2').highcharts({
        data: {
            table: document.getElementById('tabla_estadisticas2')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tiempo del grupo en el sistema'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Tiempo en minutos'
            }
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.series.name +'</b><br/>'+
                    this.y +' '+ this.x.toLowerCase();
            }
        }
    });
});


			function getParameter(parameter){
				// Obtiene la cadena completa de URL
				var url = location.href;
				/* Obtiene la posicion donde se encuentra el signo ?, 
				ahi es donde empiezan los parametros */
				var index = url.indexOf("?");
				/* Obtiene la posicion donde termina el nombre del parametro
				e inicia el signo = */
				index = url.indexOf(parameter,index) + parameter.length;
				/* Verifica que efectivamente el valor en la posicion actual 
				es el signo = */ 
				if (url.charAt(index) == "="){
					// Obtiene el valor del parametro
					var result = url.indexOf("&",index);
					if (result == -1){result=url.length;};
					// Despliega el valor del parametro
					return url.substring(index + 1,result);
				}
			} 

</script>
      

		
		
    </div><br />
</div><br />


<div id="container-9">
    <ul>
    <script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/data.js"></script>
    
        
        <div id="contenedor" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <?php
		
		 if($fecha1=="" or $fecha2 == ""){
			$query_grafica = "select date,count(exercise_id) from its_summary where course = '".$course_code."' and date != '0000-00-00' group by(date)";
			 }
		else
			 {
			 $query_grafica = "select date,count(exercise_id) from its_summary where course = '".$course_code."' and date >= '".$fecha_1_des."' and date <= '".$fecha_2_des."' and date != '0000-00-00' group by(date)";
			 }
		
	
		$resultado_grafica = mysql_query($query_grafica) or die (mysql_error());
		echo "
        	<table id='tabla_estadisticas' style = 'display:none'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>";
				while($fila = mysql_fetch_array($resultado_grafica)){
					echo "
                    <tr>
                        <th id = ''>".$fila['date']."</th>
                        <td>".$fila['count(exercise_id)']."</td>
                    </tr>";
				}
        echo "</tbody>
              </table>";
		?>
        
        <div id="contenedor2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <li>
         <?php
		 
		 if($fecha1=="" or $fecha2 == ""){
			$query_grafica = "select date,sum(elapsed_time) from its_summary where course = '".$course_code."' and date != '0000-00-00' group by(date)";
			 }
		 else
			 {
		    $query_grafica = "select date,sum(elapsed_time) from its_summary where course = '".$course_code."' and date >= '".$fecha_1_des."' and date <= '".$fecha_2_des."' and date != '0000-00-00' group by(date)";
			 }
		 
		$resultado_grafica = mysql_query($query_grafica) or die (mysql_error());
		echo "
        	<table id='tabla_estadisticas2' style = 'display:none'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>";
				while($fila = mysql_fetch_array($resultado_grafica)){
					echo "
                    <tr>
                        <th>".$fila['date']."</th>
                        <td>".($fila['sum(elapsed_time)']/60)."</td>
                    </tr>";
				}
        echo "</tbody>
              </table>";
		?>
        
        </li>        
    </ul>
</div>
<?php
Display:: display_footer();
?>


<?php
error_reporting(0);
session_start();
header("Content-Type: text/html;charset=utf-8");

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>JAA | Principal</title>
<!--[if lte IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link href="../../diseno/css/estilo.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="../../diseno/css/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.tipsy.js"></script>
<link href="../../diseno/css/tipsy.css" rel="stylesheet" type="text/css" />
<link href="../../diseno/css/tipsy-docs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(function(){
	$('#nav1>li').hover(
		function(){
		$('.submenu',this).stop(true,true).slideDown('fast');
		},
		function(){
		$('.submenu',this).slideUp('fast');
		}
	);
 
	$('.submenu li a').css( {backgroundPosition: "0px 0px"} ).hover(
		function(){
		$(this).stop().animate({backgroundPosition: "(0px -99px)"}, 250);
		},
		function(){
		$(this).stop().animate({backgroundPosition: "(0px 0px)"}, 250);
		}
	);			
});
</script>
</head>
<body>
<?php
$id_hermano=95;
?>
<div id="contenedor_header">
<?php 

		?>
	
	
</div>
</div>
<div id="cuerpo">
	<table><tr><td valign=top>
	<h3>Toma la foto y luego guardala.</h3>
	
	<!-- First, include the JPEGCam JavaScript Library -->
	<script type="text/javascript" src="src/webcam.js"></script>
	
	<!-- Configure a few settings -->
	<script language="JavaScript">
		webcam.set_api_url( 'test.php?id=<?php echo $id_hermano;?>' );
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
	</script>
	
	<!-- Next, write the movie to the page at 320x240 -->
	<script language="JavaScript">
		document.write( webcam.get_html(320, 240) );
	</script>
	
	<!-- Some buttons for controlling things -->
	<br/><form>
		<input type=button value="Configurar..." onClick="webcam.configure()">
		&nbsp;&nbsp;
		<input type=button value="Tomar foto" onClick="webcam.freeze()">
		&nbsp;&nbsp;
		<input type=button value="Guardar" onClick="do_upload()">
		&nbsp;&nbsp;
		<input type=button value="Volver a tomar" onClick="webcam.reset()">
	</form>
	
	<!-- Code to handle the server response (see test.php) -->
	<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function do_upload() {
			// upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Cargando...</h1>';
			webcam.upload();
		}
		
		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML = 
					'' + 
					'<h1>Imagen tomada</h1>' + 
					'<img src="' + image_url + '">';
				
				// reset camera for another shot
				webcam.reset();
			}
			else alert("PHP Error: " + msg);
		}
	</script>
	
	</td><td width=50>&nbsp;</td><td valign=top>
		<div id="upload_results" style="background-color:#eee;"></div>
	</td></tr>	
	</table>
	<center>
	<a href="javascript:window.history.go(-1);"><input type="button" class="boton_general" value="Regresar" name="regresar" id="regresar"/></a>
	</center>
<div id="foot_body">
    	<div id="esquina"></div>
</div>	
</div>

</body>
</html>
<?php 
mysql_close();

?>
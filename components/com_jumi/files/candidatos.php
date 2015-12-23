<?php
/**
* @version   $Id$
* @package   Jumi
* @copyright Daniel-E-Diaz 2015

*/

include_once 'include/header.php'; 
       
     $objConn = new ConnManager(); 
     $connDB = $objConn->connectDB();
    
    $user = &JFactory::getUser();
    $access = $user->id;
    $groups = $user->get('groups');
    $managerFlag= false;
    $idingreso=null;    
    $accion=null;
    /* foreach($groups as $group) {
        if($group==6 || $group==8){ $managerFlag= true;}
        if($group==8){$editFlag=true;}
     } */
    $username = $user->get('username');
    if ($managerFlag) { //ACCESO Unicamente para los usuarios del grupo: Manager, Access level: Special
    }

     $agregar=true;
     $Consulta=true;
             
     
if(isset($_POST["docIdentidad"])){     
    $accion = (isset($_POST["accion"]) ? $_POST["accion"] : null);
}
?>

<style>

.navegacion{
	background-color: #E6E6E6;
	border: 0px none transparent;
	border-radius: 2px;
	box-sizing: border-box;
	color: rgba(0, 0, 0, 0.8);
	cursor: pointer;
	display: inline-block;
	font-family: inherit;
	font-size: 100%;
	line-height: normal;
	padding: 0.5em 1em;
	text-align: center;
	text-decoration: none;
	vertical-align: middle;
	white-space: nowrap;
	-moz-user-select: none;
}

#frmCandidato
{
	border:1px solid gray;
	margin-top: 40px;
	margin-left: auto;
	margin-right: auto;
	max-width: 440px;
	padding: 20px;
	padding-right: 40px;
	padding-bottom: 40px;
}

.text
{
	display: block;
	height: 30px;
	margin-bottom: 10px;
	padding-left: 10px;
	width: 85%;
}
.combobox
{
	display: block;
	height: 30px;
	margin-bottom: 10px;
	padding-left: 10px;
	width: 45%;
}

.agregarBtn
{
         width: 70px;
         color:white;
        background-color: #6695CC;
	border: 0px none transparent;
	border-radius: 2px;
	box-sizing: border-box;
	cursor: pointer;
	display: inline-block;
	font-family: inherit;
	font-size: 100%;
	line-height: normal;
	padding: 0.5em 1em;
	text-align: center;
	text-decoration: none;
	vertical-align: middle;
	white-space: nowrap;
	-moz-user-select: none;
}

.next , #accion  { float: right; }

.prev { float: left;  }

</style>
<script type="text/javascript">
	$(function () {
		$("#frmCandidato").stepyform({
			navButtonsAttrs: {
			"class":"navegacion"
			},
			nextButtonsClass: "next",
			prevButtonsClass: "prev",
			onChangeStep: function(){
				console.log(this)
			}
		})
	})
	</script>
        
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
        <h1>Ingreso de Candidatos</h2>        
        <form action="" id="frmCandidato" name="frmCandidato"  onsubmit="do_upload()" method="POST">
        <div class="stepy-step">
            <h2>Datos Generales</h2>
            
            <br>Documento de Identidad:<br>
            <input type="text" class="text :required" id="DocIdentidad" name="DocIdentidad" value="<?php echo isset($_POST["docIdentidad"])?$_POST["docIdentidad"]:"";?>" placeholder="Documento de Identidad">
           
            
            <!-- INICIO DE CAMARA -->
            <input type="hidden" class="text" id="image_path" name="image_path" value="" placeholder="Fotografia">
        
        <table><tr><td valign=top>
	<h3>Tome la fotografia y luego guardela.</h3>
	
	<!-- First, include the JPEGCam JavaScript Library -->
	<script type="text/javascript" src="src/webcam.js" ></script>
	
	<!-- Configure a few settings -->
	<script language="JavaScript">
		webcam.set_api_url( '<?php echo $filePath; ?>test.php?id='+ document.getElementById('DocIdentidad').value);
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
	</script>
	
	<!-- Next, write the movie to the page at 320x240 -->
	<script language="JavaScript">
		document.write( webcam.get_html(320, 240) );
	</script>
	
	<!-- Some buttons for controlling things -->
	<br/>
        <form>
		<input type=button value="Tomar foto" onClick="webcam.freeze()">
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
		<div id="upload_results" style="width:100px;background-color:#eee;"></div>
	</td></tr>	
	</table>
            
            <!-- FIN DE CAMARA -->
            
             <br>Tipo de Documento:<br>
            <select id="tipo_documento" class="combobox" name="tipo_documento">
                <option value="DUI" selected>DUI</option>   
                <option value="Pasaporte">Pasaporte</option>
                <option value="Otros">Otros</option>   
            </select>
            NIT:<br>
            <input type="text" class="text" id="NIT" name="NIT" placeholder="No. de NIT (Si Aplica)">
            <br>Nombre:<br>
            <input type="text" class="text :required" id="nombre" name="nombre" placeholder="Nombre del Candidato">
            <br>Apellido:<br>
            <input type="text" class="text :required" id="apellido" name="apellido" placeholder="Apellido del Candidato">
            <br>Direccion:<br>
            <input type="text" class="text :required" id="direccion" name="direccion" placeholder="Dirección de Residencia">
            <br>Telefono:<br>
            <input type="text" class="text :required" id="telefono" name="telefono" placeholder="Numero de teléfono">
            <br>Lugar de Nacimiento:<br>
            <input type="text" class="text :required" id="lugar_nacimiento" name="lugar_nacimiento" placeholder="Lugar de Nacimiento">
            <br>Fecha de Nacimiento:<br>
            <input type="text" class="text :required" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="anio-mes-dia" value="" />
	    <img src="<?php echo $filePath; ?>images/calendar.png" style="width:20px; height:20px;"
	    onmouseover="fnInitCalendar(this, 'fecha_nacimiento', 'style=calendar.css,instance=single,close=true');" />
            <br>Sexo:<br>
            <input type="radio" name="sexo" id="sexoM" value="Masculino" checked="true">Masculino
            <input type="radio" name="sexo" id="sexoF" value="Femenino">Femenino
            <br>
            
        </div>
        <div class="stepy-step">
            <h2>Informacion Personal</h2>
            <br>Estado Civil:<br>
            <select id="estado_civil" name="estado_civil" class="combobox">
                <option value="Soltero" selected>Soltero</option>   
                <option value="Casado">Casado</option>
                <option value="Viudo">Viudo</option>
                <option value="Divorciado">Divorciado</option>
            </select>
            Nombre Conyugue:<br>
            <input type="text" class="text" id="nombre_conyugue" name="nombre_conyugue" placeholder="Conyugue (Si Aplica)">
            <br>Nombre Conyugue:<br>
            <input type="text" class="text" id="trabajo_conyugue" name="trabajo_conyugue" placeholder="Empresa que Labora">
            <br>Numero de Hijos:<br>
            <input type="text" class="text :integer" id="numero_hijos" name="numero_hijos" placeholder="Ninguno">
            <br>Nivel Academico:<br>
            <input type="text" class="text" id="nivel_academico" name="nivel_academico" placeholder="Nivel Academico">
            <br>Profesion u Oficio:<br>
            <input type="text" class="text" id="profesion_oficio" name="profesion_oficio" placeholder="Profesion">
            <br>Otros Estudios:<br>
            <input type="text" class="text" id="otros_estudios" name="otros_estudios" placeholder="Otro tipo de Estudio">
            <br>
            
        </div>
        <div class="stepy-step">
            <h2>Informacion Adicional</h2>
            <br>Tratamiento Medico:<br>
            <input type="text" class="text" id="tratamiento_medico" name="tratamiento_medico" placeholder="Ninguno">
            <br>Se&ntilde;al Especial:<br>
            <input type="text" class="text" id="senal_especial" name="senal_especial" placeholder="Ninguno">
            <br>Tatuajes:<br>
            <input type="radio" name="tatuajes" id="tatuajeSi" value="Si">Si&nbsp;&nbsp;&nbsp;
            <input type="radio" name="tatuajes" id="tatuajeNo" value="No" checked="true">No<br>
            <br>Visita Domiciliar:<br>
            <input type="radio" name="visitaDomiciliar" id="visitaDomiciliarSi" value="Si">Si&nbsp;&nbsp;&nbsp;
            <input type="radio" name="visitaDomiciliar" id="visitaDomiciliarNo" value="No" checked="true">No<br>
            <br>Posee Prestamos:<br>
            <input type="radio" name="prestamos" id="prestamosSi" value="Si">Si&nbsp;&nbsp;&nbsp;
            <input type="radio" name="prestamos" id="prestamosNo" value="No" checked="true">No<br>
            <br>Posee Vehiculo:<br>
            <input type="radio" name="posee_vehiculo" id="vehiculoSi" value="Si">Si&nbsp;&nbsp;&nbsp;
            <input type="radio" name="posee_vehiculo" id="vehiculoNo" value="No" checked="true">No<br>
            <br>Casa Propia:<br>
            <input type="radio" name="casa_propia" id="casaPropiaSi" value="Si">Si&nbsp;&nbsp;&nbsp;
            <input type="radio" name="casa_propia" id="casaPropiaNo" value="No" checked="true">No<br>
            <br>Personas Dependientes:<br>
            <input type="text" class="text :integer" id="personas_dependientes" name="personas_dependientes" placeholder="Ninguno">
            <br>
<?php

          if($idingreso==""){
?>
            <input type="submit" class="agregarBtn" id="accion" name="accion" value="Agregar">
<?php
          }else{
?>
            <input type="submit" name="accion" value="Actualizar"/>&nbsp;
            <input type="submit" name="accion" value="Eliminar" onclick="return confirm('Esta usted seguro que desea eliminar este ingreso?') ;" />
<?php
} 
?>
         
        </div>
</form>
        
<?php 

if($accion=="Agregar"){
        $excepciones="accion, view, ";
        $tabla="Candidatos";

            foreach ($_POST as $campo => $valor)
	  		{
			if (!preg_match("/$campo, /", $excepciones))
				{
			 	$campos .= "$campo='".trim(addslashes($valor))."', ";
				}
	  		}
	  		$campos = preg_replace('/, $/', '', $campos);//para quitar la coma del final de la cadena

	  		$sql = "INSERT INTO ".$tabla." SET ".$campos;
            echo $sql;
                        $sql = "";
              if (mysql_query($sql))
        	  {		
        		  echo "<script>alert('Se ha ingresado Exitosamente');</script>";
                  $idingreso=mysql_insert_id();	
        	  }
        	  else
        	  {
        		echo "<script>alert('Hubo un Error al Ingresar Registro');</script>";
        	  }
              
    }else if($accion=="Actualizar"){
        
    }

?>



        
        
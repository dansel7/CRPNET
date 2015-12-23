<?php
/**
* @version   $Id$
* @package   Jumi
* @copyright Daniel-E-Diaz 2015

*/

include_once 'include/header.php'; 
   
    // Evitar acceso directo a la php
    defined( '_JEXEC' ) or die( 'Restricted access' );
    
     $objConn         = new ConnManager(); 
     $connDB          = $objConn->connectDB();
    
    $user = &JFactory::getUser();
    $access = $user->id;
    $groups = $user->get('groups');
    $managerFlag= false;
    /* foreach($groups as $group) {
        if($group==6 || $group==8){ $managerFlag= true;}
        if($group==8){$editFlag=true;}
     } */
     $username = $user->get('username');
     if ($managerFlag) { //ACCESO Unicamente para los usuarios del grupo: Manager, Access level: Special
     }
?>

<script type="text/javascript" language="JavaScript">
    function nuevoCandidato(){

        document.forms["formPpal"].action = "<?php echo $appPath;?>&fileid=4"; 
        document.forms["formPpal"].submit();        
    }
</script>

<br>
<br>

<center>
<form method="post" action="" id="formPpal" name="formPpal">
<div>
<label for="docIdentidad">Ingrese Documento de Identificacion:</label>
<input type="text" name="docIdentidad" id="docIdentidad" value="<?php echo isset($_POST["docIdentidad"])?$_POST["docIdentidad"]:"";?>">
<br>
<input type="submit" name="busqueda" id="busqueda" value="Buscar">
</div>

</form>

<?php

if(isset($_POST["busqueda"])){
    $docIdentidad=$_POST["docIdentidad"];
    $query="select * from candidatos where DocIdentidad like '%".$docIdentidad."%'";
    $result = $objConn->runQuery($query);
    $nRegistros=(@mysqli_num_rows($result))? @mysqli_num_rows($result): 0;
    echo "<br>Se encontraron ".$nRegistros." coincidencia(s)<br><br>";
    
    if($nRegistros==0){
        
        echo '<center><input type="button" name="nuevoCand" id="nuevoCand" onclick="nuevoCandidato()" value="Agregar Nuevo Candidato"></center>';
        
    }else{
        while ($row=@mysqli_fetch_array($result)) {
        echo $row["DocIdentidad"]." --- ".$row["nombre"]." ".$row["apellido"];
        }
    }
}

$objConn->closeConnDB();
?>


</center>
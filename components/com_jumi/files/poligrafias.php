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
<style>
#candidato table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 12px;    margin: 45px;     width: 480px; text-align: left;    border-collapse: collapse; }

#candidato th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

#candidato td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

#candidato tr:hover td { background: #d0dafd; color: #339; }
</style>
    
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
    echo "<br>Se encontraron ".$nRegistros." coincidencia(s)<br>";
    
    if($nRegistros==0){
        
        echo '<center><input type="button" name="nuevoCand" id="nuevoCand" onclick="nuevoCandidato()" value="Agregar Nuevo Candidato"></center>';
        
    }else{
        echo "<div id=\"candidato\"> <table>";
        echo "<tr><th>Documento Identidad </th><th>Nombre de Candidato</th><th>Fotografia</th></tr>";
        while ($row=@mysqli_fetch_array($result)){
        echo "<tr><td>".$row["DocIdentidad"]." </td><td>".$row["nombre"]." ".$row["apellido"]."</td><td><img width=\"75px\" height=\"75px\" src=\"$filePath"."imgCandidato/".$row["image_path"]."\"></td></tr>";
        }
        echo "</table></div>";
    }
}

$objConn->closeConnDB();
?>


</center>
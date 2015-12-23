<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

if(JFactory::getUser()->guest) {
        JError::raiseNotice( 100, 'Recurso No Disponible - Compruebe Iniciar Sesion' );
        header("location: index.php");
    } 
$filePath = $myabsoluteurl=JURI::base().'components/com_jumi/files/';
$appPath = $myabsoluteurl=JURI::base().'index.php?option=com_jumi';

?>
<script type="text/javascript" language="JavaScript">

	function viewReport(formName, phpReport, idItemReport, idItemForm, reportType) {
		if(reportType == 'WEB') {
            //Llamamos la php mediante su idItemReport
			document.forms[formName].action = "<?php echo $appPath;?>&fileid=" + idItemForm;
		} else {
            //Llamamos al PHP directamente (esto no deberia de ser asi, en un futuro se podria cambiar al hallar la solucion)
			document.forms[formName].action = "<?php echo $filePath;?>" + phpReport;
		}
		
		document.forms[formName].submit();
	}
	
	
</script>


<link type="text/css" rel="stylesheet" title="calendar" href="<?php echo $filePath.'css/calendar.css'; ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo $filePath.'css/general.css'; ?>"   />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $filePath.'js/jquery-ui-1.8.11.custom.min.js'; ?>" ></script>
<script type="text/javascript" language="javascript" <?php echo 'src="'.$filePath.'js/jquery.stepyform.js"'; ?> ></script>
<script type="text/javascript" language="javascript" src="<?php echo $filePath.'js/calendar.js'; ?>" ></script>
<script type="text/javascript" language="javascript" src="<?php echo $filePath.'js/appUtils.js'; ?>" ></script>
<script type="text/javascript" language="javascript" src="<?php echo $filePath.'js/vanadium.js'; ?>" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo $filePath.'css/ui-lightness/jquery-ui-1.8.11.custom.css'; ?>" />  
<link rel="stylesheet" type="text/css" href="<?php echo $filePath.'css/autocomplete.css'; ?>" />  

<?php

include "class.ConnManager.inc.php";

?>

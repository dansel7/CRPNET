<?php
/**
* @version   $Id$
* @package   Jumi
* @copyright Daniel-E-Diaz 2015

*/

//include_once 'include/header.php'; 
   
    // Evitar acceso directo a la php
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

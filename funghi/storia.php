<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();
if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$smarty->display('storia.tpl');

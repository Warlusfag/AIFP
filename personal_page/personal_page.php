<?php
require_once 'libs/aifp_controller.php';

session_start();

$contr = new aifp_controller();
$smarty = new AIFP_smarty();


if(isset($_SESSION['user'])){
    
    $tok = $_SESSION['user'];
    $user = aifp_controller::$collection_user[$tok];
    
    $attributes = $user->attributes;
    $attributes_descr = $user->attributes_descr;
    
    //codice per la visualizzazione dell'utente
            
}else{
    $smarty->assign('error',GEN_ERROR);
    $smarty->display('error.tpl');
}

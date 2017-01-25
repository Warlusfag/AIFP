<?php
require_once '../libs/aifp_controller.php';
require_once '../libs/evento_model.php';
session_start();

$smarty = new AIFP_smarty();

if(isset($_SESSION['user'])){
    if(isset($_POST['evento'])){
        $tok = $_SESSION['user'];
        $user = aifp_controller::$collection_user[$tok];
        if(!$user->register_evento($_POST['evento'])){
            $smarty->assign('error',$user->err_descr);            
        }else{
            $smarty->assign('message','Inscrizione avvenuta con successo');    
        }		
    }else{
        $smarty->assign('error', GEN_ERROR);        
    }
    $smarty->display('eventi.tpl');
}else{
    $smarty->display('index.tpl');
}
    
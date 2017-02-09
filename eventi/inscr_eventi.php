<?php
session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
$contr = new aifp_controller();

if(isset($_SESSION['curr_user'])){
    if(isset($_POST['evento'])){
        $params = $_SESSION['curr_user']['token'];        
        $user = $cont->get_user($params, $_SESSION['curr_user']['type']);
        if(!$user->register_evento($_POST['evento'])){
            $smarty->assign('error',$user->err_descr);            
        }else{
            $smarty->assign('message','Inscrizione avvenuta con successo');    
        }		
    }else{
        $smarty->assign('error', GEN_ERROR);        
    } 
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    

    $smarty->display('eventi.tpl');
}else{
    $smarty->display('index.tpl');
}
    
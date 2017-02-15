<?php
session_start();
require_once '../libs/aifp_controller.php';

function check_post($param){
    $app = array();
    foreach ($param as $key=>$value){        
        $app[$key] = $value;
        
    }
    return $app;
}

$smarty = new AIFP_smarty();
$controller = new aifp_controller();

$us = $controller->get_us_from_type($_SESSION['curr_user']['type']);
$us->init($_SESSION['curr_user']);
if(($post = check_post($_POST))){
    $us->update_user($post);
    if($us->err_descr == ''){
        foreach ($post as $key=>$value){
            $_SESSION['curr_user'][$key] = $value;
        }            
        $smart->assign('message','aggiornamento profilo eseguito con successo');
    }else{
        $smarty->assign('error',$us->err-descr);            
    }
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


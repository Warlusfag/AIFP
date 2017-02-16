<?php
session_start();
require_once '../libs/aifp_controller.php';
$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('sessione'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

if(!isset($_SESSION['curr_user'])){
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}

function check_post($param){
    $app = array();
    foreach ($param as $key=>$value){        
        $app[$key] = $value;
        
    }
    return $app;
}


$controller = new aifp_controller();

$us = $controller->get_us_from_type($_SESSION['curr_user']['type']);
$us->init($_SESSION['curr_user']);
if(($post = check_post($_POST))){
    $us->update_user($post);
    if($us->err_descr == ''){
        foreach ($post as $key=>$value){
            $_SESSION['curr_user'][$key] = $value;
        }            
        $smarty->assign('message','aggiornamento profilo eseguito con successo');
    }else{
        $smarty->assign('error',$us->err-descr);            
    }
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


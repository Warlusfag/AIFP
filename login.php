<?php

require_once 'libs/aifp_controller.php';    

function check_post($param){
    $app = array();    
    foreach ($param as $key=>$value){
        if( $key == 'user' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'password' ){
            $app[$key] = sanitaze_input($value);
        }           
    }
    return $app; 
}
    
try{
    $smarty = new AIFP_smarty();
    $contr = new aifp_controller();

    if(($post = check_post($_POST)) ){
        $user = $contr->login($pwd, $em);
        if($user){
            session_start();
            $SESSION['user']= $user;           
        }else{            
            $smarty->assign('error', $contr->descritpion);
            $smarty->display('error.tpl');
        }
    }
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');

} catch (Exception $ex){

    session_destroy();
    $smarty->assign('error', $ex->getMessage());
    $smarty->display('error.tpl');
}   
<?php
require_once '../libs/aifp_controller.php';


function check_post($param){
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
        }
        else if( $key == 'cognome' ){
            $app[$key] = $value;
        }
        else if( $key == 'password' ){
            $app[$key] = $value;
        }
        else if( $key == 'residenza' ){
            $app[$key] = $value;
        }
        else if( $key == 'user' ){
            $app[$key] = $value;
        } 
        else if( $key == 'data' ){
            $app[$key] = $value;
        }else if( $key == 'email' ){
            $app[$key] = $value;
        } 
    }
    return $app;
}
$smart = new AIFP_smarty();
if(isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    $us = aifp_controller::$collection_user[$tok];
    if(($post = check_post($_POST))){
        if($us->update_user($post)){ 
            $smart->assign('message','aggiornamento profilo eseguito con successo');
        }else{
            $smarty->assign('error',$us->err-descr);
            
        }
        $smarty->display('update_profile.tpl');
    }   
}else{
    $smarty->assign('error',GEN_ERROR);
    $smarty->display('index.tpl');
}

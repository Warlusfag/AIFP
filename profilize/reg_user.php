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

$smarty = new AIFP_smarty();

if(($post = check_post($_POST))){           

    $user = new user();
    
    if($user->insert_user($post, array())){
        
    }else{
        $smarty->assign('error', GEN_ERR);
        $smarty->display('error.tpl');
    }  
}else{
    $smarty->assign('error', GEN_ERR);
    $smarty->display('error.tpl');
}

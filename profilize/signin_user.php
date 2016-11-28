<?php

require_once 'libs/aifp_controller.php';

function check_post($param){
    $app = array();
    try{
        foreach ($param as $key=>$value){
            if( $key == 'nome' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'cognome' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'password' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'residenza' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'user' ){
                $app[$key] = sanitaze_input($value);
            } 
            else if( $key == 'data' ){
                $app[$key] = sanitaze_input($value);
            }else if( $key == 'email' ){
                $app[$key] = sanitaze_input($value);
            } 
        }
        return $app;
    }catch(Exception $ex){
        return null;
    }   
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

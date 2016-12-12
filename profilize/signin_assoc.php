<?php

require_once '../libs/aifp_controller.php';

function check_post($param){
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'provincia' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'password' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'residenza' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'CAP' ){
            $app[$key] = sanitaze_input($value);
        } 
        else if( $key == 'email' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'sito_web' ){
            $app[$key] = sanitaze_input($value);
        }
    }
    return $app;
}

$smarty = new AIFP_smarty();

if(($post = check_post($_POST))){           

    $user = new associazione();    
    if($user->register_assoc($post)){
        //registrazione effettuato con successo!!
    }else{
        $smarty->assign('error', GEN_ERR);
        $smarty->display('error.tpl');
    }  
}else{
    $smarty->assign('error', GEN_ERR);
    $smarty->display('error.tpl');
}

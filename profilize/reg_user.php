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
        else if( $key == 'regione' ){
            $app[$key] = $value;
        }
        else if( $key == 'residenza' ){
            $app[$key] = $value;
        }
        else if( $key == 'regione' ){
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

$message = "Congratulazioni, lei si è appena registrato al nostro sito";

$smarty = new AIFP_Smarty();

if( (($post= check_post($_POST))) ){
    $user = new user();    
    if($user->insert_user($post, array())){
        $smarty->assign('message',$message);
        $smarty->display('index.tpl');
    }else{
        $smarty->assign('error', $user->err_descr);
    }    
}else{
    $smarty->assign('error', GEN_ERROR);
}    

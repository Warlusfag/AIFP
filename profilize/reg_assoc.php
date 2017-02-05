<?php

require_once '../libs/aifp_controller.php';

function check_post($param){
    $app = array();
    $i = 0;
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'provincia' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'password' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'user' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'CAP' ){
            $app[$key] = $value;
            $i++;
        } 
        else if( $key == 'email' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'sito_web' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'componenti' ){
            $app[$key] = $value;
            $i++;
        }
    }
    if($i == 8){
        return $app;
    }else{
        return null;
    }    
}
$message = "Congratulazioni, lei si è appena registarto al nostro sito";

$smarty = new AIFP_Smarty();

if( (($post= check_post($_POST))) ){
    $user = new associazione();    
    if($user->register_assoc($post)){
        $smarty->assign('message',$message);
    }else{
        $smarty->assign('error', $user->err_descr);
    }    
}else{
    $smarty->assign('error', GEN_ERROR);
}    



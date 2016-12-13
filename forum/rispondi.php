<?php

require_once '../libs/aifp_controller.php';
session_start();
function check_post ($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'conversazione' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'text' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'sezione' ){
            $app[$key] = sanitaze_input($value);
        }
    }
    return $app;
}

$smarty = new AIFP_smarty();

if (isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    $user = aifp_controller::$collection_user[$tok];    
    if (($post = check_post($_POST))){
        
        $sez = aifp_controller::$collection_sez[$post['sezione']];
        $conv = $sez->convs[$post['conversazione']];            
        $us = $user->attributes['user'];
        
        $post = new post();
        if($post->new_post($post['text'], $us, $conv->attributes['key'])){
                     
        }else{
            $smarty->assign('error',GEN_ERROR);
            $smarty->display('error.tpl');
        }        
    }else{
        $smarty->assign('error',GEN_ERROR);
        $smarty->display('error.tpl');
    }
}else{
    //login
}

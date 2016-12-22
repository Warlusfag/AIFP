<?php
require_once '../libs/aifp_controller.php';
require_once '../libs/evento_model.php';

session_start();

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome_evento' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'indirizzo' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'regione' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'provincia' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'data_inizio' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'data_fine' ){
            $app[$key] = sanitaze_input($value);
        } 
    }
    return $app;  
}

$smarty = new AIFP_smarty();

if(($post = check_post($_POST))){
    $ev = new evento();
    if($events = $ev->search_eventi($post)){
        $smarty->assign('eventi',$events);
		$smarty->display('eventi.tpl');
    }else{
        $smarty->assign('error', $ev->err_descr);
        $smarty->display('error.tpl');
    }   
}else{
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');
}

<?php
require_once 'libs/aifp_controller.php';

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
    $events = $ev->search_eventi($post);
    if($ev->err_descr == ''){
        $smarty->assign($events);
    }else{
        //smarty error
    }   
}else{
    //smarty error
}
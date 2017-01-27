<?php
require_once '../libs/aifp_controller.php';

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome_evento' ){
            $app[$key] = $value;
        }
        else if( $key == 'indirizzo' ){
            $app[$key] =$value;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
        }
        else if( $key == 'provincia' ){
            $app[$key] =$value;
        }
        else if( $key == 'data_inizio' ){
            $app[$key] = $value;
        }
        else if( $key == 'data_fine' ){
            $app[$key] = $value;
        } 
    }
    return $app;  
}

$smarty = new AIFP_smarty();

if(($post = check_post($_POST))){
    $ev = new evento();
    $events = $ev->search_eventi($post, -1, 20);
    if($events){
        $smarty->assign('eventi',$events);	
    }else{
        $smarty->assign('error', $ev->err_descr);        
    }   
}else{
    $smarty->assign('error', GEN_ERROR);    
}
$smarty->display('eventi.tpl');
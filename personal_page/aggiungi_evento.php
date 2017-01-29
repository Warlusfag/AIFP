<?php

require_once '../libs/aifp_controller.php';

session_start();

function check_post($param)
{
    $app = array();
    $i = 0;
    foreach ($param as $key=>$value){
        if( $key == 'nome_evento' ){
            $app[$key] = $value;
            $i += 1;
        }
        else if( $key == 'indirizzo' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'provincia' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'data_inizio' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'data_fine' ){
            $app[$key] = $value;
            $i++;
        } 
    }
    if(i == 6){
        return $app;  
    }else{
        return null;
    }
}

$smarty = new AIFP_smarty();
$tok = $_SESSION['user']; 
$ass = aifp_controller::$collection_user[$tok];
if( $ass instanceof associazione ){ 

    if(($post = check_post($_POST))){            

        if($ass->add_evento($post)){
            $smarty->assign('error', $ass->err_descr);
        }else{
            $smarty->assign('message', 'evento aggiornato con successo');                
        }
    }else{
        $smarty->assign('error', 'BAD parameters');
    }
    $smarty->display('eventi.tpl');
}else
{
    session_destroy();
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('index.tpl');
}

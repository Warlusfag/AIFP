<?php

require_once '../libs/aifp_controller.php';
require_once '../libs/evento_model.php';

session_start();

function check_post($param)
{
    $app = array();
	$flag = array();
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
$tok = $_SESSION['user']; 
$ass = aifp_controller::$collection_user[$tok];
    if( $ass instanceof associazione ){      

        if(($post = check_post($_POST))){            

            if($ass->add_evento($post)){
                
            }else{
                $smarty->assign('error', $ass->err_descr);
                $smarty->display('error.tpl');
            }
        }    
    }else
    {
        session_destroy();
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');
    }

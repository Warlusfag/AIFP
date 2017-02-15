<?php
session_start();

require_once '../libs/aifp_controller.php';

function check_post($param)
{
    $app = array();
    $i = 0;
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
            $i += 1;
        }
        else if( $key == 'tipologia' ){
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
    if($i == 6){
        return $app;  
    }else{
        return null;
    }
}

$smarty = new AIFP_smarty();
$c = new aifp_controller();

$type = $_SESSION['curr_user']['type'];
if($type == 'associazione'){
    $ass = $c->get_us_from_type($type);
    $ass->init($_SESSION['curr_user']);
    $post = check_post($_POST);
    if($ass->add_evento($post)){
        unset($_SESSION['news']);
        $smarty->assign('message', 'evento aggiunto con successo');                
    }else{
        $smarty->assign('error', $ass->err_descr);
    }
}else{
    $smarty->assign('error', "ERROR:non sei autorizzato ad utilizzare questa funzionalita'");
}
foreach($_SESSION['curr_user'] as $key=>$value){
            $t[$key] = $value;
}

$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');
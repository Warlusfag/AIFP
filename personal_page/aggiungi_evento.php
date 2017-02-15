<?php
session_start();

require_once '../libs/aifp_controller.php';
$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('sessione'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

if(!isset($_SESSION['curr_user'])){
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}

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
$smarty->assign('feventi',1);
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');
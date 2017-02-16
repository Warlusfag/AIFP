<?php

session_start();

require_once '../libs/aifp_controller.php';
$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('error'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
        }
        else if( $key == 'data_inizio' ){
            $app[$key] = $value;
        }
        else if( $key == 'tipologia' ){
            $app[$key] = $value;
        }
    }
    return $app;  
}

if(isset($_POST) && count($_POST)>0){
    if(($post = check_post($_POST))){
        $ev = new evento();
        $events = $ev->search_eventi($post, -1, 20);
        if($ev->err_descr == ''){
            $smarty->assign('eventi',$events);	
        }else{
            $smarty->assign('error', $ev->err_descr);        
        }
    }
}

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$smarty->display('eventi.tpl'); 

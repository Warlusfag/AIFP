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

$contr = new aifp_controller();

if(isset($_SESSION['curr_user'])){
    if(isset($_POST['evento'])){
        $user = $contr->get_us_from_type($_SESSION['curr_user']['type']);
        $user->init($_SESSION['curr_user']);
        if(!$user->register_evento($_POST['evento'])){
            $smarty->assign('error',$user->err_descr);            
        }else{
            $_SESSION['partecipati'][] = $_POST['evento'];
            $smarty->assign('message','Inscrizione all\'evento avvenuta con successo');    
        }		
    }else{
        $smarty->assign('error', GEN_ERROR);        
    } 
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t ); 
    $new_col = unserialize($_SESSION['news']);
    $news = $new_col->get_all_news();
    
    $smarty->assign('eventi', $news );
    $part = $_SESSION['partecipati'];
    $smarty->assign('partecipati',$part);

    $smarty->display('eventi.tpl');
}else{
    $smarty->display('index.tpl');
}
    
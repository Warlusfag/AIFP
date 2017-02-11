<?php
session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
$contr = new aifp_controller();

if(isset($_SESSION['curr_user'])){
    if(isset($_POST['evento'])){
        $params = $_SESSION['curr_user']['token'];        
        $user = $contr->get_user($params, $_SESSION['curr_user']['type']);
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
    
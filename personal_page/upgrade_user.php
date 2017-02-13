<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();


if(isset($_POST['email'])){
    if(isset($_SESSIONS['curr_user'])){
        $controller = new aifp_controller();
        $tok = $_SESSIONS['curr_user']['token'];
        $type = $_SESSIONS['curr_user']['type'];
        $ass = $controller->get_user($tok, $type);
    }else{
        $ass = -1;    
    }
    if($ass instanceof associazione || $ass instanceof admin){

        $email = $_POST['email'];
        if(!isset($_POST['type'])){
            $smarty->assign('error', GEN_ERROR);            
        }else{
            if($ass->upgrade_user($email, $_POST['type'])){
                $smarty->assign('message', 'upgrade dell\' utente avvenuto con successo');
            }else{
                $smarty->assign('error', $ass->err_descr);
            }
        }
        $smarty->display('personal_page.tpl');
    }else{
        unset($_SESSIONS['curr_user']);
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('personal_page.tpl');
    }
}else{
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('personal_page.tpl');    
}

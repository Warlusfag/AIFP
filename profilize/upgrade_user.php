<?php
require_once '../libs/aifp_controller.php';

session_start();

$smarty = new AIFP_smarty();

if(isset($_POST['email'])){
    $token = $_SESSION['user'];
    $ass = aifp_controller::$collection_user[$token];
    if($ass instanceof associazione){

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
        session_destroy();
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('index.tpl');
    }
}else{
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('personal_page.tpl');    
}

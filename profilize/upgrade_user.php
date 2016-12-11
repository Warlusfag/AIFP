<?php
require_once 'libs/aifp_controller.php';

session_start();

$smarty = new AIFP_smarty();

if(isset($_POST['email'])){

    $token = $_SESSION['user'];
    $ass = aifp_controller::$collection_user[$token];
    if($ass instanceof associazione){

        $email = sanitaze_input($_POST['email']);
        if(!isset($_POST['type'])){
            $smarty->assign('error', GEN_ERROR);
            $smarty->display('error.tpl');
        }else{
            if($ass->upgrade_user($email, $_POST['type'])){
                //successp nell'upgrade del nuovo utente
                //biusogna richiedere un nuovo login
            }else{
                $smarty->assign('error', $ass->err_descr);
                $smarty->display('error.tpl');
            }
        }
    }else{
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');
    }
}else{
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');
    
}

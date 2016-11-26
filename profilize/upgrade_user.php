<?php
require_once 'libs/aifp_controller.php';

session_start();

$smarty = new AIFP_smarty();
$contr = new aifp_controller();

if($_SESSION['ip'] == $_SERVERS['REMOTE_ADDR']){
    
    if($_SESSION['user'] instanceof associazione ){
        
        if(isset($_POST['email'])){

            $ass = $_SESSION['user'];
            $email = sanitaze_input($_POST['email']);

            $ass->upgrade_user($email);

            if($ass->isok == ''){
                //codice per il corretto upgrade dell'utente
                $smarty->assign();
                $smarty->display();
            }else{
                $smarty->assign('error', $ass->isok);
                $smarty->display('error.tpl');
            }            
        }else{
            $smarty->assign('error', 'Email is not set');
            $smarty->display('error.tpl');
        }        
    }
    else{
        session_destroy();
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');
    }
}
else{
    session_destroy();
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');
}

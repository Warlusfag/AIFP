<?php
session_start();
require_once '../libs/aifp_controller.php';
$smarty = new AIFP_smarty();
if(isset($_POST['email']) && isset($_POST['type'])){
    if(isset($_SESSIONS['curr_user'])){
        $controller = new aifp_controller();        
        $type = $_SESSIONS['curr_user']['type'];
        $ass = $controller->get_us_from_type($type);
        $ass->init($_SESSIONS['curr_user']);
        if($ass instanceof associazione || $ass instanceof admin){
            $email = $_POST['email'];           
            if($controller->upgrade_user($ass->attributes, $email, $_POST['type'])){
                $smarty->assign('message', "L'upgrade dell'utente con ".$email." e' avvenuto con successo" );
                //codice per mandare un email
            }else{
                $smarty->assign('error', $controller->description);
            }            
            $smarty->display('personal_page.tpl');
        }else{
            $smarty->assign('error', "ERROR: non sei autorizzato ad utilizare questa funzionalita'");
        }
    }
}else{
    $smarty->assign('error', GEN_ERROR);       
}
$smarty->display('personal_page.tpl'); 

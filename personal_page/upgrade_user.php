<?php
session_start();
require_once '../libs/aifp_controller.php';
$smarty = new AIFP_smarty();
if(isset($_POST['email']) && isset($_POST['type'])){
    
    $controller = new aifp_controller();        
    $type = $_SESSION['curr_user']['type'];
    $ass = $controller->get_us_from_type($type);
    $ass->init($_SESSION['curr_user']);
    
    if($ass instanceof associazione){
        $email = $_POST['email'];           
        if($controller->upgrade_user($ass->attributes, $email, $_POST['type'])){
            $smarty->assign('message', "L'upgrade dell'utente con ".$email." e' avvenuto con successo" );
            //codice per mandare un email
        }else{
            $smarty->assign('error', $controller->description);
        }            
    }else{
        $smarty->assign('error', "ERROR: non sei autorizzato ad utilizare questa funzionalita'");
    }
    
}else{
    $smarty->assign('error', GEN_ERROR);       
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl'); 

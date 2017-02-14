<?php
session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
$contr = new aifp_controller();

$tok = $_SESSION['curr_user']['token'];
$tipo = $_SESSION['curr_user']['type'];
$user = $contr->get_user($tok, $tipo);

if($user  instanceof admin) {
    $reqass = $user->show_req_assoc();
    if(!is_array($reqass) || $user->err_descr != ''){
        $smarty->assign('error',$user->err_descr);
    }else{
        $smarty->assign('reqass',$reqass);
    }
}else{
    $smarty->assign('error',"ERROR: non sei autorizzato ad entrare in questa sezione");    
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


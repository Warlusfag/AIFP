<?php
session_start();

require_once '../libs/aifp_controller.php';

if(isset($_SESSION['req_ass'])){
    $_SESSION['req_ass'] = array();
}

$smarty = new AIFP_smarty();
$contr = new aifp_controller();
$type = $_SESSION['curr_user']['type'];
$user = $contr->get_us_from_type($type);
$user->init($_SESSION['curr_user']);

if($user  instanceof admin) {
    $reqass = $user->show_req_assoc();
    if(!is_array($reqass) || $user->err_descr != ''){
        $smarty->assign('error',$user->err_descr);
        unset($_SESSION['req_ass']);
    }else{
        $_SESSION['req_ass'] = $reqass;
        $smarty->assign('reqass',$reqass);
    }
}else{
    $smarty->assign('error',"ERROR: non sei autorizzato ad entrare in questa sezione");
    unset($_SESSION['req_ass']);
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


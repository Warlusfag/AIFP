<?php
session_start();

require_once '../libs/aifp_controller.php';
$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('sessione'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

if(!isset($_SESSION['curr_user'])){
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}

if(isset($_SESSION['req_ass'])){
    $_SESSION['req_ass'] = array();
}

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
$smarty->assign('ass',1);
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


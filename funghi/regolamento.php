<?php
session_start();
require_once '../libs/aifp_controller.php';
if(isset($_SESSION['curr_user'])){
    $tok = $_SESSION['curr_user']['token'];    
    $user = $contr->get_user($tok);
    
    $controller = new aifp_controller();
    
    $path = $controller->get_regolamento($user->attributes['provincia']);
    if($path){
        download($path);
        $smarty->assign('message',"Il download partirà automaticamente, attendere...");
    }else{
        $smarty->assign('error', $controller->description);
    }
    
    $smarty->assign('user',$_SESSION['curr_user']['user']);
    $smarty->assign('image',$_SESSION['curr_user']['image']);
}
$smarty = new AIFP_Smarty();
$smarty->display('regolamento.tpl');

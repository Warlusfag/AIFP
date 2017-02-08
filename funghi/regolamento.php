<?php
session_start();
require_once '../libs/aifp_controller.php';

$controller = new aifp_controller();

if(isset($_GET['regione'])){
    $path = $controller->get_regolamento($_GET['regione']);
    if($path){        
        $smarty->assign('path',$path);
    }else{
        $smarty->assign('error', $controller->description);
    }
}else if(isset($_GET['miaregione']) && isset($_SESSION['curr_user']) ){
    $tok = $_SESSION['curr_user']['token'];    
    $user = $contr->get_user($tok);    
    
    $path = $controller->get_regolamento($user->attributes['provincia']);
    if($path){        
        $smarty->assign('path',$path);
    }else{
        $smarty->assign('error', $controller->description);
    }
}
if(isset($_SESSION['curr_user']) ){
    $smarty->assign('user',$_SESSION['curr_user']['user']);
    $smarty->assign('image',$_SESSION['curr_user']['image']);
}

$smarty = new AIFP_Smarty();
$smarty->display('regolamento.tpl');

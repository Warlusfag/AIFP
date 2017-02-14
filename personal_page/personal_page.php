<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
$c = new aifp_controller();
if(isset($_SESSION['curr_user'])){    
    if(isset($_SESSION['curr_user'])){   
        foreach($_SESSION['curr_user'] as $key=>$value){
            $t[$key] = $value;
        }
        $smarty->assign('profilo', $t );
        $smarty->display('personal_page.tpl');
    }else{
        unset($_SESSION['curr_user']);
        $smarty->display('index.tpl');
    }
}else{
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}


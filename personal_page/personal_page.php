<?php
session_start();
require_once '../libs/aifp_controller.php';


$smarty = new AIFP_smarty();
$c = new aifp_controller();
if(isset($_SESSION['curr_user'])){    
    $tok = $_SESSION['curr_user']['token'];
    $t = $_SESSION['curr_user']['type'];        
    if( ($user = $c->get_user($tok, $t)) ){   
        $attributes = $user->get_attributes();
        $smarty->assign('type',$user->type);
        $smarty->assign('personal_data',$attributes);
                
        $smarty->display('personal_page.tpl');
    }else{
        unset($_SESSION['curr_user']);
        $smarty->display('index.tpl');
    }
}else{
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}


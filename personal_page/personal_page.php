<?php
session_start();
require_once '../libs/aifp_controller.php';


$smarty = new AIFP_smarty();
$coll = unserialize($_SESSION['users']);
$c = new aifp_controller();
if(isset($_SESSION['curr_user'])){    
    $tok = $_SESSION['curr_user'];
    if( ($user = $coll->getitem($tok)) ){   
        $attributes = $user->attributes;
        $attributes_descr = $user->attributes_descr;
        
        $smarty->assign('user', $user->attributes['user'] );
        $smarty->assign('image', $user->get_image());
        $smarty->assign('personal_data',$attributes);
        $smarty->assign('descr_data', $attributes_descr);
        $smarty->display('personal_page.tpl');
    }else{
        unset($_SESSION['curr_user']);
    }
}else{
    $smarty->display('index.tpl');
}


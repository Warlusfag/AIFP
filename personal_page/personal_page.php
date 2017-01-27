<?php
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();


if(isset($_SESSION['user'])){
    
    $tok = $_SESSION['user'];
    $user = aifp_controller::$collection_user[$tok];
    
    $attributes = $user->attributes;
    $attributes_descr = $user->attributes_descr;
    
    $smarty->assign('personal_data',$attributes);
    $smarty->assign('descr_data',$attributes_descr);
    $smarty->display('personal_page.tpl');
}else{
    $smarty->display('index.tpl');
}


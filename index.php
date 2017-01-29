<?php

session_start();

require_once 'libs/aifp_controller.php';
require_once 'libs/collection.php';

$smarty = new AIFP_Smarty();

if(isset($_SESSION['curr_user'])){
    $tok = $_SESSION['curr_user'];
    $coll = unserialize($_SESSION['users']);
    if( ($us = $coll->getitem($tok)) ){        
        $smarty->assign('user', $us->attributes['user'] );
        $image = $us->get_image();
        $smarty->assign('image',$image );
    }else{
        unset($_SESSION['curr_user']);
    }
}
$contr = new aifp_controller();
$news = $contr->get_news();
if($contr->descritpion != ''){
    $smarty->assign('error',GEN_ERROR);
}else{
    $smarty->assign('news',$news);
}
$smarty->display('index.tpl');


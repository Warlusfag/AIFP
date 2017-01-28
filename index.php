<?php
require_once 'libs/aifp_controller.php';

$smarty = new AIFP_Smarty();

if(isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    if(isset(aifp_controller::$collection_user[$tok])){
        $us = aifp_controller::$collection_user[$tok];
        $smarty->assign('user', 'Benvenuto '.$us->attributes['user'] );
        $smarty->assign('image', $us->attributes_descr['image']);
    }else{
        unset($_SESSION['user']);
        session_destroy();
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


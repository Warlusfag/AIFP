<?php
require_once '../libs/aifp_controller.php';
require_once '../libs/funghi_model.php';

sessiona_start();
$smarty = new AIFP_smarty();

if(isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    $us = aifp_controller::$collection_user[$tok];
    $username = $us->attributes['user'];
    
    $params = array();
    foreach($_POST as $key=>$value){
        $params[$key] = $value;
    }
    
    $fungo = new funghi();
    $fung = $fungo->search_funghi($params, $username);
    
    if($fungo->err_descr != ''){
        $smarty->assign('error',$funghi->err_descr);
    }else{
        $smarty->assign('funghi',$fung);
    }
    $smarty->display('search_funghi.tpl');
}else{
    $smarty->display('index.tpl');    
}


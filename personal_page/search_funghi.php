<?php
session_start();

if (!isset($_SESSION['view'])){
    $_SESSION['view'] = 'funghi';
}
require_once '../libs/aifp_controller.php';


$smarty = new AIFP_smarty();
$controller = new aifp_controller();

if(isset($_SESSION['curr_user'])){
    
    if( ($type = $_SESSION['curr_user']['type']) != 'user' ){
        $smarty->assign('error',"ERROR: you are not authorized to perform this action");
        $smarty->display('personal_page.tpl'); 
    }
    
    $us = $_SESSION['curr_user']['user'];

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


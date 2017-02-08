<?php
session_start();

require_once '../libs/aifp_controller.php';


if (!isset($_SESSION['view'])){
    $_SESSION['view'] = 'funghi';
}

$smarty = new AIFP_smarty();
$fungo = new funghi();
if(isset($_POST['reset'])){
    if($_SESSION['view'] != $fungo->table_descr['table']){   
        $fungo->set_view($_SESSION['view']);
        if($fungo->reset_search()){
            $_SESSION['view'] = $fungo->table_descr['table'];
        }
    }
}
else if(isset($_SESSION['curr_user'])){    
    if( ($type = $_SESSION['curr_user']['type']) != 'user' ){
        $smarty->assign('error',"ERROR: you are not authorized to perform this action");
        $smarty->display('personal_page.tpl'); 
    }
    
    $username = $_SESSION['curr_user']['user'];
        
    $params = array();
    foreach($_POST as $key=>$value){
        $params[$key] = $value;
    }    
    
    $_SESSION['view'] = $fungo->preapare_dynaimic_search($_SESSION['view'], $username);
    $fung = $fungo->search_funghi($params, 20);
    
    if($fungo->err_descr != ''){
        $smarty->assign('error',$funghi->err_descr);
    }else{
        $smarty->assign('funghi',$fung);
    }
    $smarty->display('search_funghi.tpl');
}else{
    $smarty->display('index.tpl');    
}


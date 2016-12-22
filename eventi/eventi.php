<?php
require_once '../libs/aifp_controller.php';
require_once '../libs/evento_model.php';

session_start();


$smarty = new AIFP_smarty();
$contr = new aifp_controller();

$news = $contr->get_news();
if($news){
    $smarty->assign('error', $ev->err_descr);
    $smarty->display('error.tpl');

}else{
    $smarty->assign('error', $ev->err_descr);
    $smarty->display('error.tpl');

}

   

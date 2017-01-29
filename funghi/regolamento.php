<?php
session_start();
require_once '../libs/aifp_controller.php';
if(isset($_SESSION['curr_user'])){
    $smarty->assign('user',$_SESSION['curr_user']['user']);
    $smarty->assign('image',$_SESSION['curr_user']['image']);
}
$smarty = new AIFP_Smarty();
$smarty->display('regolamento.tpl');

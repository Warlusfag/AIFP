<?php
session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();
if(isset($_SESSION['curr_user'])){
    if(isset($_SESSION['curr_user'])){   
        $smarty->assign('user', $_SESSION['curr_user']['user'] );
        $smarty->assign('image', $_SESSION['curr_user']['image']);   
    }
}
$smarty->display('funghi.tpl');

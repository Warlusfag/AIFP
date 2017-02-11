<?php
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$new_col = unserialize($_SESSION['news']);
$news = $new_col->get_all_news();

$smarty->assign('eventi', $news );
$smarty->display('libri.tpl');

<?php

session_start();

require_once 'libs/aifp_controller.php';
require_once 'libs/collection.php';

$smarty = new AIFP_Smarty();

if(isset($_SESSION['curr_user'])){         
    $smarty->assign('user', $_SESSION['curr_user']['user'] );
    $image = $_SESSION['curr_user']['image'];
    $smarty->assign('image',$image );
}
$new_col = unserialize($_SESSION['news']);
if(!$new_col->is_load()){
    $contr = new aifp_controller();
    $news = $contr->get_news();
    $new_col->add_all_news($news);
    $_SESSION['news'] = serialize($new_col);    
}else{
    $news = $new_col->get_all_news();
}
if(!is_array($news)){
    $smarty->assign('error',GEN_ERROR);
}else{
    $smarty->assign('news',$news);
}
$smarty->display('index.tpl');


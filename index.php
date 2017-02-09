<?php

session_start();

require_once 'libs/aifp_controller.php';

if (!isset($_SESSION['news'])){
    $_SESSION['news'] = serialize(new news_collection());
}

$smarty = new AIFP_Smarty();

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
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


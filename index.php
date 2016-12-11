<?php
require_once 'libs/aifp_controller.php';

//session_start();

$contr = new aifp_controller();
$smarty = new AIFP_Smarty();

 if(isset($_SESSION['user'])){
    //codice di benvenuto
}else{
    $contr->get_news();
    $news = aifp_controller::$collection_news;
    if(!$ev){
        $smarty->assign('error',GEN_ERROR);
        $smarty->display('error.tpl');
    }else{
        $smarty->assign('news',$news);
        $smarty->display('index.tpl');
    }
}
$smarty->display('index.tpl');


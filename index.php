<?php
require_once 'libs/aifp_controller.php';
//require_once 'libs/admin/setup.php';
session_start();

//$contr = new aifp_controller();
$smarty = new AIFP_Smarty();
/*
 if(isset($_SESSION['user'])){
    //codice di benvenuto
}else{
    $ev = $contr->eventi();
    $news = $ev->show_news(20);
    if(!$news){
        $smarty->assign('error',GEN_ERROR);
        $smarty->display('error.tpl');
    }else{
        $smarty->assign('news',$news);
        $smarty->display('index.tpl');
    }
}

/*Codice prova del funzionamento smarty
$smarty->assign('name', 'Gabriele');
$smarty->assign('title', 'Hello World');
*/

$smarty->display('index.tpl');


<?php
session_start();
require_once 'libs/aifp_controller.php';

$smarty = new AIFP_smarty();

session_destroy();
$smarty->assign('message','log out avvenuto con successo, Arriverderci!');
$new_col = unserialize($_SESSION['news']);
$news = $new_col->get_all_news();
$smarty->assign('news', $news );
$smarty->display('index.tpl');
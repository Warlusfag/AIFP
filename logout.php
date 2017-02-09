<?php
session_start();
require_once 'libs/aifp_controller.php';

$smarty = new AIFP_smarty();

session_destroy();
$smarty->assign('message','log out avvenuto con successo, Arriverderci!');
$smarty->display('index.tpl');
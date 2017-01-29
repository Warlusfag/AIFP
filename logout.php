<?php
session_start();
require_once 'libs/aifp_controller.php';

$smarty = new AIFP_smarty();

$collection = unserialize($_SESSION['users']);
$tok = $_SESSION['curr_user']['token'];
$collection->deleteitem($tok);
$_SESSION['users'] = serialize($collection);
unset($_SESSION['curr_user']);
$smarty->assign('message','log out avvenuto con successo, Arriverderci!');
$smarty->display('index.tpl');
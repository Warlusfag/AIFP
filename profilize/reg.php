<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();

$smarty->display('reg.tpl');

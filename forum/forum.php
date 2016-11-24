<?php

require_once 'libs/aifp_controller.php';

$contr = new aifp_controller();
$smarty = new AIFP_smarty();

$contr->forum();
if($contr->descritpion != ''){
    $smarty->assign(GEN_ERROR);
    $smarty->display('error.tpl');
}
$sez = aifp_controller::$collection_sez;

$smarty->assign($sez);
$smarty->display('forum.tpl');




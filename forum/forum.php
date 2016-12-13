<?php
//nel forum io faccio l'elenco delle sezioni che ci stano
require_once '../libs/aifp_controller.php';

$contr = new aifp_controller();
$smarty = new AIFP_smarty();

$sez = $contr->forum();
if($contr->descritpion != ''){
    $smarty->assign(GEN_ERROR);
    $smarty->display('error.tpl');
}else{    
    $smarty->assign($sez);
    $smarty->display('forum.tpl');
}




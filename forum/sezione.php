<?php

require_once 'libs/aifp_controller.php';

$contr = new aifp_controller();
$smarty = new AIFP_smarty();

if(isset($_POST['sezione']))
{
   
}
else
{
    $smarty->assign('error','Internal server error');
    $smarty->display('error.tpl');    
}
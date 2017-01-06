<?php
require_once '../libs/aifp_controller.php';



/*if(isset($_GET['genere'])){
    $smarty = new AIFP_Smarty();
    $contr = new aifp_controller();
    
    $funghi = $contr->get_scheda_funghi($_GET['genrere']);
    if(!$funghi){
        $smarty->assign('error',$contr->descritpion);
        $smarty->display('error.tpl');
    }else{
        $smarty->assign('funghi',$funghi);
        $smarty->display('generic_page.tpl');
    }
   } 
    */


$smarty = new AIFP_Smarty();
$smarty->display('schede.tpl');




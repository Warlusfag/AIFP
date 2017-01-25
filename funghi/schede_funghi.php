<?php
require_once '../libs/aifp_controller.php';


$smarty = new AIFP_Smarty();
/*if(isset($_GET['genere'])){
    $smarty = new AIFP_Smarty();
    $contr = new aifp_controller();
    
    $funghi = $contr->get_scheda_funghi($_GET['genere']);
    if(!$funghi){
        $smarty->assign('error',$contr->descritpion);
        
    }else{
        $smarty->assign('funghi',$funghi);
        $smarty->display('generic_page.tpl');
    }
   } 
    */

$smarty->display('schede.tpl');




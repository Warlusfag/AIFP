<?php
require_once 'libs/aifp_controller.php';

session_start();

$contr = new aifp_controllere();
$smarty = new AIFP_smarty();

if ($_SESSION['ip']==$_SERVER['REMOTE_ADDR']){
    if(isset($_SESSION['user'])){
        
        $user = $_SESSION['user'];        
        
        //Codice per visualizzare tutto il contenuto della personal page
        
    }else{
        $smarty->assign('error',GEN_ERROR);
        $smarty->display('error.tpl');
    }  
}else{
    session_destroy();
    $smarty->assign('error',GEN_ERROR);
    $smarty->display('error.tpl');
}
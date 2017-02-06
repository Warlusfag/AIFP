<?php
session_start();

require_once '../libs/aifp_controller.php';

$contr = new aifp_controller();
$smarty = new AIFP_smarty();

if(isset($_POST['tipologia']) ){
    $tipologia = $_POST['tipologia'];    
}else{
    $tipologia = -1;            
}
$temp = $contr->get_prodotti($tipologia); 
if($contr->descritpion != ''){
    $smarty->assign('error',GEN_ERROR);
}else{    
    $smarty->assign('prodotti',$temp);
}
if(isset($_SESSION['curr_user'])){
    $smarty->assign('user',$_SESSION['curr_user']['user']);
    $smarty->assign('image',$_SESSION['curr_user']['image']);
}
$smarty->display('prodotti.tpl');

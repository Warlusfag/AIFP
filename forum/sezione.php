<?php
//Questa pagina carica le conversazioni all'interno di una sezione
require_once '../libs/aifp_controller.php';

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}

$smarty = new AIFP_smarty();

if(isset($_POST['sezione']))
{
    $i = $_POST['sezione'];
    $sez = aifp_controller::$collection_sez[$i];    
    if($sez->load_conv($page)){
        $conv = $sez->get_conversazioni($page);
        $smarty->assign('conversazioni',$conv);
    }       
}else{
    $smarty->assign('error',GEN_ERROR);    
}
$smarty->display('sezione.tpl.tpl');
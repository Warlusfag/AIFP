<?php
//Questa pagina carica le conversazioni all'interno di una sezione
require_once '../libs/aifp_controller.php';

//La prima volta che apro una sezione l'utente  non ha potuto selezionare la pagina
if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}

$smarty = new AIFP_smarty();

if(isset($_POST['sezione'])){
    $i = $_POST['sezione'];
    if(isset(aifp_controller::$collection_sez[$i])){
        $sez = aifp_controller::$collection_sez[$i];
    }else{
        //lesezioni devono essere tutte caricate
        $smarty->assign('error',GEN_ERROR);
    }
    if($sez->load_conv($page)){
        $conv = $sez->get_conversazioni($page);
        if($sez->err_descr != ''){
            $smarty->assign('error',$sez->err_descr);
        }else{
            $smarty->assign('num_sez',$i);
            $smarty->assign('conversazioni',$conv);            
        }        
    }
}else{
    $smarty->assign('error',$sez->err_descr);    
}
$smarty->display('sezione.tpl');
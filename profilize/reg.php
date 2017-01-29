<?php
session_start();
require_once '../libs/aifp_controller.php';

$message = "Congratulazioni, lei si è appena inscritto al nostro sito";

$smarty = new AIFP_Smarty();
if(isset($_POST['tipo'])){
    if($_POST['tipo'] == 'user') {
        if( reg_assoc($_POST) ){
            $smarty->assign('message', $message);
        }else{
            $smarty->assign('error', GEN_ERROR);
        }
    }else if($_POST['tipo'] == 'associazione'){
        if( reg_user($_POST) ){
            $smarty->assign('message', $message);
        }else{
            $smarty->assign('error', GEN_ERROR);
        }
    }
}
$smarty->display('reg.tpl');

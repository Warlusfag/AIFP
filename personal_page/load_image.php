<?php
session_start();
require_once 'libs/aifp_controller.php';

$smarty = new AIFP_smarty();
$controller = new aifp_controller();

if(isset($_SESSSION['curr_user']) && isset($_POST['image'])){
    $img = $_POST['image'];    
    $tok = $_SESSSION['curr_user']['token'];
    $type = $_SESSSION['curr_user']['type'];
    $user = $controller->get_user($tok, $type);

    if($user->load_image($img)){
        $smarty->assign('message',"L'immagine e' stata caricata con successo");
    }else{
        $smarty->assign('error',$user->err_descr);
    }
}
$smarty->display('personal_page.tpl');
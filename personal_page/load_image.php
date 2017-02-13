<?php
session_start();
require_once 'libs/aifp_controller.php';

$smarty = new AIFP_smarty();
$controller = new aifp_controller();

$type_image = array('image/jpg', 'image/jpeg', 'image/png');

if(isset($_SESSSION['curr_user']) && isset($_FILES['image'])){
    $img = $_FILES['image'];
    if($img['error'] > 0){
        $smarty->assign('error',"ERROR: file caricato non correttamente, riprovare!");
    }else{        
        $flag = false;
        foreach($type_image as $ext){
            if($ext == $img['type']){
                $flag = true;
                break;
            }
        }
        if($flag){
            $tok = $_SESSSION['curr_user']['token'];
            $type = $_SESSSION['curr_user']['type'];
            $user = $controller->get_user($tok, $type);
            if($user->load_image($img)){
                $smarty->assign('message',"L'immagine e' stata caricata con successo");
            }else{
                $smarty->assign('error',$user->err_descr);
            }            
        }else{
            $smarty->assign('error',"ERROR: l'immagine caricata non è supportata");
        }
    }
    $smarty->display('personal_page.tpl');
}else{
    session_destroy();
    $smarty->assign('error', GEN_ERROR);    
    $smarty->display('index.tpl');
}

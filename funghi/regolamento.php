<?php
session_start();
require_once '../libs/aifp_controller.php';

$controller = new aifp_controller();
$smarty = new AIFP_smarty();

if(isset($_GET['regione'])){
    $path = $controller->get_regolamento($_GET['regione']);
    if($path){        
        $smarty->assign('path',$path);
    }else{
        $smarty->assign('error', $controller->description);
    }
}else if(isset($_GET['miaregione']) ){
    if(isset($_SESSION['curr_user'])){
        $tok = $_SESSION['curr_user']['token'];    
        $user = $controller->get_user($tok);    

        $path = $controller->get_regolamento($user->attributes['regione']);
        if($path){        
            $smarty->assign('path',$path);
        }else{
            $smarty->assign('error', $controller->description);
        }
    }else{
        $smarty->assign('error', "Per scaricare in automatico la tua regione, devi essere loggato");
    }
}
if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$new_col = unserialize($_SESSION['news']);
$news = $new_col->get_all_news();
$smarty->assign('news', $news );

$smarty->display('regolamento.tpl');

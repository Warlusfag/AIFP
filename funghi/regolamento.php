<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('error'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

$controller = new aifp_controller();

if(isset($_GET['regione'])){
    $path = $controller->get_regolamento($_GET['regione']);
    if($path){        
        $smarty->assign('path',$path);
    }else{
        $smarty->assign('error', $controller->description);
    }
}else if(isset($_GET['miaregione']) ){
    if(isset($_SESSION['curr_user'])){
        $user = $controller->get_us_from_type($_SESSION['curr_user']['type']);
        $user->init($_SESSION['curr_user']);    

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
if(isset($_SESSION['news'])){
    $new_col = unserialize($_SESSION['news']);
    $news = $new_col->get_all_news();
    $smarty->assign('news', $news );
}else{
    $new_col = new news_collection();
    $news = $controller->get_news();
    $new_col->add_all_news($news);
    $_SESSION['news'] = serialize($new_col);
}
$smarty->display('regolamento.tpl');

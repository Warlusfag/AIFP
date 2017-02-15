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
    $contr = new aifp_controller();
    $news = $contr->get_news();
    $new_col->add_all_news($news);
    $_SESSION['news'] = serialize($new_col);
}
$smarty->display('funghi.tpl');

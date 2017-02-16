<?php
session_start();

require_once '../libs/aifp_controller.php';

if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage    
}
$_SESSION['inactivity'] = time();

if (!isset($_SESSION['news'])){
    $_SESSION['news'] = serialize(new news_collection());
}

if (!isset($_SESSION['partecipati'])){
    $_SESSION['partecipati'] = array();
}

$smarty = new AIFP_Smarty();
$new_col = unserialize($_SESSION['news']);
if(!$new_col->is_load()){
    $contr = new aifp_controller();
    $news = $contr->get_news();
    if($contr->description != ''){
        $smarty->assign('error', $contr->description);
    }
    $new_col->add_all_news($news);
    $_SESSION['news'] = serialize($new_col);
}else{
    $news = $new_col->get_all_news();
}

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$part = $_SESSION['partecipati'];
$smarty->assign('partecipati',$part);
$smarty->assign('eventi',$news);
$smarty->display('eventi.tpl'); 

   

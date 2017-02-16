<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('sessione'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();
if(!isset($_SESSION['curr_user'])){
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 0;
}

$controller = new aifp_controller();

$coll_c = unserialize($_SESSION['convs']);
$convs = array();
$s = $_POST['s_index'];
$c = $_POST['c_index'];
$tito_sez=$_POST['sezione'];
$tito_conv = $_POST['conversazione'];

if(isset($_POST['page_conv'])){
    $cpage = $_POST['page_conv'];
}else{ 
    $cpage = 0;
}  
$t = $coll_c->getitem($cpage);
$attr = $t[$c];
$conv = new conversazione();
$conv->init($attr);

$posts = $conv->get_posts();
if($posts == false || $conv->err_descr != ''){
    $smarty->assign('error',$conv->err_descr);  
}else{
    //Codice per aggiungere informazioni nei post degli utenti
    if( ($temp = $controller->prepare_post($posts)) ){
        $smarty->assign('posts', $temp);         
    }else{
        $smarty->assign('error',$contr->description);
    }    
}
$smarty->assign('s_index',$s);
$smarty->assign('c_index',$c);
$smarty->assign('sezione',$tito_sez);
$smarty->assign('conversazione',$tito_conv);
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );

$smarty->display('conversazione.tpl');
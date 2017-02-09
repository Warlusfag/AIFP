<?php

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}

$smarty = new AIFP_smarty();
$coll_c = unserialize($_SESSION['convs']);
$convs = array();
$s = $_POST['sezione'];
$c = $_POST['conversazione'];
if(isset($_POST['page_conv'])){
    $cpage = $_POST['page_conv'];
}else{ 
    $cpage = 0;
}
    
$t = $coll_c->getitem($cpage);
$attr = $t[$c];
$conv = new conversazione();
$conv->init($attr);

$posts = $conv->get_post();
if($posts == false){
    $smarty->assign('error',$conv->err_descr);  
}else{
    $smarty->assign('sezione',$s);
    $smarty->assign('conversazione',$c);
    $smarty->assign('posts', $posts);
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('conversazione.tpl');
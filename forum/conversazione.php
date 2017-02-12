<?php

require_once '../libs/aifp_controller.php';

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 0;
}

$smarty = new AIFP_smarty();
$controller = new aifp_controller();

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
    //Codice per aggiungere informazioni nei post degli utenti
    for($i=0;$i<count($posts);$i++){
        $us = $controller->get_us_from_type($posts[$i]['tipo_user']);
        $params = array($us->table_descr['key'] => $posts[$i]['user']);
        $user = $controller->get_user($params);
        $posts[$i] = array_merge($posts[$i], $user->get_attributes('post'));
    }
    $smarty->assign('posts', $posts);
}
$smarty->assign('sezione',$s);
$smarty->assign('conversazione',$c);
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('conversazione.tpl');
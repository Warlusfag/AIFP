<?php
session_start();
//nel forum io faccio l'elenco delle sezioni che ci stano
require_once '../libs/aifp_controller.php';

if (!isset($_SESSION['convs'])){
    $_SESSION['convs'] = serialize(new conv_collection());
}
//La prima volta che apro una sezione l'utente  non ha potuto selezionare la pagina
if(isset($_GET['page'])){
    $page = $_GET['page'] -1;    
}else{
    $page = 0;
}
$smarty = new AIFP_smarty();
$coll_c = unserialize($_SESSION['convs']);
$convs = array();
$i = $_POST['sezione'];
$flag = true;
//
if( $coll_c->sezione == $i){
    if( ($convs = $coll_c->getitem($page)) != false){
        $smarty->assign('convs',$convs);
    }
}else{
    //l'utente ha cambiato sezione e devo caricare tutte le conversazioni di quella sezione
    $coll_c->sezione = $i;
    $coll_c->erase();
    $c_sez = unserialize($_SESSION['forum']);
    $temp = $c_sez->getitem($i);
    $sez = new sezione();
    $sez->init($temp);
    $convs = $sez->get_conversazioni();
    if($sez->err_descr != ''){
        $smarty->assign('error',$sez->err_descr);
        $flag = false;
    }else{
        $coll_c->additem($convs, $page);
        $_SESSION['convs'] = serialize($coll_c);
        $smarty->assign('convs', $convs);
    }
}
$smarty->assign('sezione',$i);
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
if($flag){
    $smarty->display('sezione.tpl');               
}else{
    $smarty->display('forum.tpl');
}


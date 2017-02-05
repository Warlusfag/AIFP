<?php
if (!isset($_SESSION['convs'])){
    $_SESSION['convs'] = serialize(new conv_collection());
}

//nel forum io faccio l'elenco delle sezioni che ci stano
require_once '../libs/aifp_controller.php';

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
    
if( $coll_c->sezione == $i){
    if( ($convs = $coll_c->getitem($page)) != false){
        $smarty->assign('convs',$convs);
        $smarty->assign('sezione',$i);
        $smarty->display('sezione.tpl');
    }
}else{
    $coll_c->sezione = $i;
    $coll_c->erase();
}
$c_sez = unserialize($_SESSION['forum']);
if(($sez = $c_sez->getitem($i)) == false){
    $convs = $sez->get_conversazioni();
    $coll_c->additem($page, $convs);
    $_SESSION['convs'] = serialize($coll_c);
}
$smarty->assign('sezione',$i);
$smarty->assign('convs',$convs);
$smarty->display('sezione.tpl');               


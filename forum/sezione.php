<?php
session_start();
//nel forum io faccio l'elenco delle sezioni che ci stano
require_once '../libs/aifp_controller.php';

function load_newconv($coll_c, $s_index, $page){
    $coll_c->sezione = $s_index;
    $coll_c->erase();
    $c_sez = unserialize($_SESSION['forum']);
    $temp = $c_sez->getitem($s_index);
    $sez = new sezione();
    $sez->init($temp);
    $convs = $sez->get_conversazioni();
    if($sez->err_descr != ''){
        return $sez->err_descr;
    }else{
        $coll_c->additem($convs, $page);
        $_SESSION['convs'] = serialize($coll_c);
        return $convs;
    }
}

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

if (!isset($_SESSION['convs'])){
    $_SESSION['convs'] = serialize(new conv_collection());
}
//La prima volta che apro una sezione l'utente  non ha potuto selezionare la pagina
if(isset($_GET['page'])){
    $page = $_GET['page'] -1;    
}else{
    $page = 0;
}

$coll_c = unserialize($_SESSION['convs']);
$convs = array();
$i = $_POST['s_index'];
$titolo = $_POST['sezione'];
$flag = false;

if( $coll_c->sezione == $i){
    if( ($convs = $coll_c->getitem($page)) != false){
        $flag = true;
        $smarty->assign('convs',$convs);
    }
}else{
    //l'utente ha cambiato sezione e devo caricare tutte le conversazioni di quella sezione
   $ris = load_newconv($coll_c, $i, $page);
   if(is_array($ris)){
       $flag = true;
       $smarty->assign('convs', $ris);
   }
}
$smarty->assign('s_index',$i);
$smarty->assign('sezione',$titolo);
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );

if($flag){
    $smarty->display('sezione.tpl');               
}else{
    $smarty->display('forum.tpl');
}


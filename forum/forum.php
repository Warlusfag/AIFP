<?php
session_start();

//nel forum io faccio l'elenco delle sezioni che ci stano
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
if (!isset($_SESSION['forum'])){
    $_SESSION['forum'] = serialize(new sezioni_collection());
}
$flag = true;
$contr = new aifp_controller();
$coll_s = unserialize($_SESSION['forum']);
$sez = array();

if($coll_s->is_load()){    
    for($i=0;$i<$coll_s->count();$i++){
        $sez[$i] = $coll_s->getitem($i);        
    }
}else{
    $temp = $contr->forum();
    for($i=0;$i<count($temp);$i++){
        $s = $temp[$i];
        $coll_s->additem($s,$i);
        $sez[$i] = $s;        
    }
    $_SESSION['forum'] = serialize($coll_s);
}
if($contr->description != ''){
    $smarty->assign('error',GEN_ERROR);
    $flag = false;
}else{    
    $smarty->assign('sez',$sez);
}

foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
if($flag){
    $smarty->display('forum.tpl');
}else{
    $smarty->display('index.tpl');
}

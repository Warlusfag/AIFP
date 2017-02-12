<?php
session_start();

//nel forum io faccio l'elenco delle sezioni che ci stano
require_once '../libs/aifp_controller.php';

if(!isset($_SESSION['curr_user'])){
    $smarty = new AIFP_smarty();
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}
if (!isset($_SESSION['forum'])){
    $_SESSION['forum'] = serialize(new sezioni_collection());
}

$contr = new aifp_controller();
$smarty = new AIFP_smarty();
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
}else{    
    $smarty->assign('sez',$sez);
}

foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->display('forum.tpl');

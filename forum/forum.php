<?php
session_start();

if (!isset($_SESSION['forum'])){
    $_SESSION['forum'] = serialize(new sezioni_collection());
}

//nel forum io faccio l'elenco delle sezioni che ci stano
require_once '../libs/aifp_controller.php';

$contr = new aifp_controller();
$smarty = new AIFP_smarty();
$coll_s = unserialize($_SESSION['forum']);
$sez = array();

if($coll_s->is_load()){    
    for($i=0;$i<$coll_s->count();$i++){
        $s = $coll_s->getitem($i);
        $sez[$i] = $s->attributes;
    }
}else{
    $temp = $contr->forum();
    for($i=0;$i<count($temp);$i++){
        $s = $sez[$i];
        $coll_s->additem($s,$i);
        $sez[$i] = $s->attributes;
        $_SESSION['forum'] = serialize($col_s);
    }
}
if($contr->descritpion != ''){
    $smarty->assign('error',GEN_ERROR);
}else{    
    $smarty->assign('sezioni',$sez);
}
$smarty->display('forum.tpl');

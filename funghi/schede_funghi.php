<?php
session_start();

if (!isset($_SESSION['funghi'])){
    $_SESSION['funghi'] = serialize(new funghi_collection());
}

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();
//$_GET['genere'] = 'lactarius';
if(isset($_GET['genere'])){
    $genere = $_GET['genere'];
    $collection = unserialize($_SESSION['funghi']);
    if( ($funghi=$collection->getitem($genere))==false){
        $contr = new aifp_controller();
        $funghi = $contr->get_scheda_funghi($genere);
    }
    if(!$funghi){
        $smarty->assign('error',$contr->description);    
    }else{
        $smarty->assign('genere',$funghi);
    }
}else{
    $photo = array();
    $base_path = './foto_generi/';
    $files = scandir($base_path);
    $i = 0;
    foreach($files as $file){
        if($file == '.' || $file == '..'){
            continue;
        }
        $t = explode('.',$file);
        $f = $base_path.$file;
        $photo[$i] = array($t[0], $f);
        $i++;
    }
    $smarty->assign('foto',$photo);
}
if(isset($_SESSION['curr_user'])){
    $smarty->assign('user',$_SESSION['curr_user']['user']);
    $smarty->assign('image',$_SESSION['curr_user']['image']);
}
$smarty->display('schede.tpl');
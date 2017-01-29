<?php
session_start();
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
        $photo[$i] = $base_path.$file;
    }
    $smarty->assign('foto',$photo);
}
$smarty->display('schede.tpl');
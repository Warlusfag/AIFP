<?php
session_start();


require_once '../libs/aifp_controller.php';

if (!isset($_SESSION['funghi'])){
    $_SESSION['funghi'] = serialize(new funghi_collection());
}


$smarty = new AIFP_Smarty();
//$_GET['genere'] = 'lactarius';
if (!isset($_SESSION['funghi'])){
    $_SESSION['funghi'] = serialize(new funghi_collection());
}



if(isset($_GET['genere'])){
    $genere = $_GET['genere'];
    $collection = unserialize($_SESSION['funghi']);
    
    if( ($funghi=$collection->getitem($genere))==false){
        $contr = new aifp_controller();
        $funghi = $contr->get_scheda_funghi($genere);
    }
    if($contr->description != ''){
        $smarty->assign('error',$contr->description);    
    }else{
        $smarty->assign('genere',$_GET['genere']);
        //preparo i dati iin uscita
        $temp = array();
        for($i=0;$i<count($funghi);$i++){
            $f = new funghi();
            $f->init($funghi[$i]);
            $temp[$i] = $f->get_attributes('genere,specie,foto1');
        }
        $smarty->assign('funghi',$temp);
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
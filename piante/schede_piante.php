<?php
session_start();

require_once '../libs/aifp_controller.php';

if (!isset($_SESSION['piante'])){
    $_SESSION['piante'] = serialize(new piante_collection());
}


$smarty = new AIFP_Smarty();
//$_GET['genere'] = 'lactarius';
if(isset($_GET['genere'])){
    $genere = $_GET['genere'];
    $collection = unserialize($_SESSION['piante']);
    if( ($piante=$collection->getitem($genere))==false){
        $contr = new aifp_controller();
        $piante = $contr->get_schede_piante($genere);
    }
    if($contr->description != ''){
        $smarty->assign('error',$contr->description);    
    }else{
        $smarty->assign('genere',$_GET['genere']);
        //preparo i dati iin uscita
        $temp = array();
        for($i=0;$i<count($piante);$i++){
            $p = new piante();
            $p->init($piante[$i]);
            $temp[$i] = $p->get_attributes('genere,specie');
            //aggiungo la foto
            $f = $p->get_photos();            
            $temp[$i]['foto'] = $f[0];
        }
        $smarty->assign('piante',$temp);
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
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$smarty->display('schede_piante.tpl');


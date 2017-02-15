<?php
session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('error'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

if (!isset($_SESSION['funghi'])){
    $_SESSION['funghi'] = serialize(new funghi_collection());
}

if(isset($_GET['genere'])){
    $genere = $_GET['genere'];
    $collection = unserialize($_SESSION['funghi']);
    $error = '';
    if( ($funghi=$collection->getitem($genere))==false){
        
        $contr = new aifp_controller();
        $funghi = $contr->get_scheda_funghi($genere);
        if($contr->description != ''){
            $error = $contr->description;
        }
        $collection->additem($funghi, $genere);
        $_SESSION['funghi'] = serialize($collection);
        
    }
    if($error != ''){
        $smarty->assign('error',$error);    
    }else{
        $smarty->assign('genere',$_GET['genere']);
        //preparo i dati iin uscita
        $temp = array();
        for($i=0;$i<count($funghi);$i++){
            $f = new funghi();
            $f->init($funghi[$i]);
            $temp[$i] = $f->get_attributes('genere,specie,commestibile');
            //aggiungo la foto
            $p = $f->get_photos();            
            $temp[$i]['foto'] = $p[0];            
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
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$smarty->display('schede.tpl');
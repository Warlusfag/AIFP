<?php

session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$tipologia = $_GET['tipologia'];
$genere = $_GET['genere'];
$specie = $_GET['specie'];
$collection = unserialize($_SESSION['piante']);
$p = $collection->getitem($tipologia);
$flag = false;
for($i=0;$i<count($p);$i++){
    if($p[$i]['specie'] == $specie && $p[$i]['genere'] == $genere ){            
        $flag = true;
        break;
    }   
}
if($flag == false){
    $smarty->assign('error','Nessuna descrizione di questo fungo trovata');
}else{
    $pianta = new piante();
    $pianta->init($p[$i]);
    $smarty->assign('descrizione',$pianta->get_attributes());
    $photos = $pianta->get_photos();
    $smarty->assign('foto',$photos);
}
$smarty->display('pianta.tpl');

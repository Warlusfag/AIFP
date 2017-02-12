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
$collection = unserialize($_SESSION['funghi']);
$f = $collection->getitem($_GET['genere']);
$flag = false;
for($i=0;$i<count($f);$i++){
    foreach($f[$i] as $key=>$value){
        if($key == 'specie'){
            if($value == $_GET['specie']){
                $flag = true;
                break;
            }
        }
    }
    if($flag){break;}
}
if($flag == false){
    $smarty->assign('error','Nessuna descrizione di questo fungo trovata');
}else{
    $fungo = new funghi();
    $fungo->init($f[$i]);
    $smarty->assign('descrizione',$fungo->get_attributes());
    $photos = $fungo->get_photos();
    $smarty->assign('foto',$photos[0]);
}
$smarty->display('fungo.tpl');

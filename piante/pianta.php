<?php

session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_Smarty();

if(isset($_SESSION['curr_user'])){
    $smarty->assign('user',$_SESSION['curr_user']['user']);
    $smarty->assign('image',$_SESSION['curr_user']['image']);
}
$collection = unserialize($_SESSION['piante']);
$p = $collection->getitem($_GET['genere']);
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
    $pianta = new piante();
    $pianta->init($p[$i]);
    $smarty->assign('descrizione',$pianta->get_attributes());
}
$smarty->display('pianta.tpl');

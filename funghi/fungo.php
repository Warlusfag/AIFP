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

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}

if(isset($_SESSION['funghi'])){
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
        $smarty->assign('foto',$photos);
    }
    $smarty->display('fungo.tpl');
}else {
    $smarty->display('schede.tpl');
}



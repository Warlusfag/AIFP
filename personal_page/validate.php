<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('sessione'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

if(!isset($_SESSION['curr_user'])){
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}

$contr = new aifp_controller();

$type = $_SESSION['curr_user']['type'];
$user = $contr->get_us_from_type($type);
$user->init($_SESSION['curr_user']);
if($user  instanceof admin) {
    $id = $_POST['id_ass'];
    $assoc = $_SESSION['req_ass'];
    $flag = false;
    for($i=0;$i<count($assoc);$i++){
        if($i == $id){
            $flag = true;
            break;
        }
    }
    if($flag == false){
        $smarty->assign('error',"ERROR: Associazione non trovata");    
    }else{        
        $ass = $assoc[$i];
        $user->register_assoc($ass);
        if($user->err_descr != ''){
            $smarty->assign('error',$user->err_descr);
        }else{           
            unset($assoc[$i]);
            $_SESSION['req_ass'] = array_values($assoc);
            $smarty->assign('reqass',$_SESSION['req_ass']);
            $smarty->assign('message',"L'associazione è registrata con successo");
        }        
    }    
}else{
    $smarty->assign('error',"ERROR: non sei autorizzato ad entrare in questa sezione");    
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('ass',1);
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


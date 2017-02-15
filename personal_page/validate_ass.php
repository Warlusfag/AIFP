<?php

session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
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
            for($j=0;$i<count($assoc);$j++){
                if($j < $i){
                    $_SESSION['req_ass'][$j] = assoc[$j]; 
                }else if($j == $i){
                    unset($_SESSION['req_ass'][$j]);
                }else{
                    $_SESSION['req_ass'][$j-1] = assoc[$j]; 
                }
            }
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
$smarty->assign('profilo', $t );
$smarty->display('personal_page.tpl');


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

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
        }
        else if( $key == 'moderatore' ){
            $app[$key] = $value;
        }
        else if( $key == 'descrizione' ){
            $app[$key] = $value;
        }
    }
    return $app;
}

$contr = new aifp_controller();

$type = $_SESSION['curr_user']['type'];
$user = $contr->get_us_from_type($type);
$user->init($_SESSION['curr_user']);

if($user  instanceof admin) {
    $post = check_post($_POST);
    if(count($post) > 0){
        $user->insert_section($post);
        if($user->err_descr != ''){
            $smarty->assign('error',$user->err_descr);
        }else{
            $smarty->assign('message',"Sezione inserità correttamente");
            if(isset($_SESSION['forum'])){
                unset($_SESSION);
            }
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
<?php

session_start();
require_once '../libs/aifp_controller.php';

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

$smarty = new AIFP_smarty();
$contr = new aifp_controller();

$tok = $_SESSION['curr_user']['token'];
$tipo = $_SESSION['curr_user']['type'];
$user = $contr->get_user($tok, $tipo);

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
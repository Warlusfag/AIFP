<?php

require_once '../libs/aifp_controller.php';

function check_post($param){
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
        }
        else if( $key == 'cognome' ){
            $app[$key] = $value;
        }
        else if( $key == 'password' ){
            $app[$key] = $value;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
        }
        else if( $key == 'residenza' ){
            $app[$key] = $value;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
        }
        else if( $key == 'user' ){
            $app[$key] = $value;
        } 
        else if( $key == 'data' ){
            $app[$key] = $value;
        }else if( $key == 'email' ){
            $app[$key] = $value;
        } 
    }
    return $app;
}

$message = "Congratulazioni, lei si è appena registrato al nostro sito";

$smarty = new AIFP_Smarty();
$contr = new aifp_controller();

if( (($post= check_post($_POST))) ){
    $user = new user();
    $params = array(
        'email' => $post['email'],
    );
    $test = $contr->search_OnAll_users($params,1);
    if(count($test)>0){
        $smarty->assign('error', $user->err_descr);
    }else{    
        if($user->insert_user($post, array())){
            $smarty->assign('message',$message);            
        }else{
            $smarty->assign('error', $user->err_descr);
        }
    }
}else{
    $smarty->assign('error', GEN_ERROR);
}    
$smarty->display('index.tpl');
<?php

require_once '../libs/aifp_controller.php';

function check_post($param){
    $app = array();
    $i = 0;
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'provincia' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'password' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'user' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'CAP' ){
            $app[$key] = $value;
            $i++;
        } 
        else if( $key == 'email' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'sito_web' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'componenti' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'indirizzo' ){
            $app[$key] = $value;
            $i++;
        }
    }
    if($i == 10){
        return $app;
    }else{
        return null;
    }    
}
$message = "Richiesta di iscizione avvenuto con successo! Attendi che il nostro team verichi l'identità dell'associazione, le verrà inviata una mail di conferma il prima possibile!";

$smarty = new AIFP_Smarty();
$contr = new aifp_controller();

if( (($post= check_post($_POST))) ){
    $user = new associazione();
    $params = array(
        'email' => $post['email'],
    );
    $test = $contr->search_OnAll_users($params,1);
    if(count($test)>0){
        $smarty->assign('error', $user->err_descr);
    }
    else{ 
        if($user->register_assoc($post)){
            $smarty->assign('message',$message);
        }else{
            $smarty->assign('error', $user->err_descr);
        }    
    }
}else{
    $smarty->assign('error', GEN_ERROR);
}    
$smarty->display('index.tpl');


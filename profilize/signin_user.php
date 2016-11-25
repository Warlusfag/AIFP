<?php

require_once 'libs/aifp_controller.php';

function check_post($param){
    $app = array();
    try{
        foreach ($param as $key=>$value){
            if( $key == 'nome' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'cognome' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'password' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'residenza' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'user' ){
                $app[$key] = sanitaze_input($value);
            } 
            else if( $key == 'data' ){
                $app[$key] = sanitaze_input($value);
            } 
        }
        return $app;
    }catch(Exception $ex){
        return null;
    }   
}

$smarty = new AIFP_smarty();

if(($post = check_post($_POST))){           

    if(user::register_user($post['nome'], $post['cognome'], $post['email'], $post['password'], $post['user'], $post['data'], $post['residenza']) ){
        //Codice per do conferma di avvenuta registrazione
        $smarty->assign();
        $smarty->display();
        
    }else{
        $smarty->assign('error', $ass->isok);
        $smarty->display('error.tpl');
    }
    
}else{
    $smarty->assign('error', GEN_ERR);
    $smarty->display('error.tpl');
}

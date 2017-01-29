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
        else if( $key == 'residenza' ){
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


function reg_user($post){
    if(($post = check_post($post))){
        $user = new user();    
        if($user->insert_user($post)){
            return true;
        }else{
            return false;
        }    
    }else{
        return false;
    }    
}
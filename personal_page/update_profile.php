<?php
require_once '../libs/aifp_controller.php';

session_start();

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
if(isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    $us = aifp_controller::$collection_user[$tok];
    $smarty = new AIFP_smarty();
    if(($post = check_post($_POST))){
        if($us->update_user($post)){
            //smarty results ok
        }else{
            $smarty->assign();
            $smarty->display();
        }
    }   
}else{
    //error smarty general
}

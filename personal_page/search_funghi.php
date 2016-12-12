<?php
require_once '../libs/aifp_controller.php';
require_once '../libs/funghi_model.php';

sessiona_start();

if(isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    $us = aifp_controller::$collection_user[$tok];
    $username = $us->attributes['user'];
    
    $params = array();
    foreach($_GET as $key=>$value){
        $params[$key] = sanitaze_input($value);
    }
    
    $fungo = new funghi();
    $fung = $fungo->search_funghi($params, $username);
    
    if($fungo->err_descr != ''){
        //smarty error
    }else{
        
    }   
}else{
    
    
}

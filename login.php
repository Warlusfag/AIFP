<?php

require_once 'libs/aifp_controller.php'; 

function check_post($param){
    $app = array();
    if(isset($param['type'])){
        $app['type'] = $param['type'];
    }else{
        $app['type'] = -1;
    }    
    foreach ($param as $key=>$value){
        if( $key == 'user' ){
            $app[$key] = $value;
        }		
        else if( $key == 'password' ){
            $app[$key] = $value;
        }
        else if( $key == 'email' ){
            $app[$key] = $value;
        }       
    }
    return $app; 
}

$smarty = new AIFP_smarty();

$contr = new aifp_controller();
if(!isset($_SESSION['user'])){
    
    if(($post = check_post($_POST)) ){		
        $pwd = $post['password'];
        if(isset($post['email'])){
                $em = $post['email'];
                $token = $contr->login($pwd, $em, -1, $post['type']);
        }else if(isset($post['user'])){
                $us = $post['user'];
                $token = $contr->login($pwd, -1, $us, $post['type']);
        }
        if($token){
                session_start();
                $_SESSION['user']= $token;
                $us = aifp_controller::$collection_user[$token];
                
                $smarty->assign('user', $us->attributes['user'] );
                $smarty->assign('image', $us->attributes_descr['image']);
        }else{            
                $smarty->assign('error', $contr->descritpion);
        }
    }else{
            $smarty->assign('error', GEN_ERROR);
    }
}else{
    if(isset(aifp_controller::$collection_user[$_SESSION['user']])){
        $us = aifp_controller::$collection_user[$token];
        $smarty->assign('user', $us->attributes['user'] );

    }else{
        session_destroy();
        $smarty->assign('error', GEN_ERROR);
    }
}
$smarty->display('index.tpl');


  
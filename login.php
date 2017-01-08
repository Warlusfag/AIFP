<?php

require_once 'libs/aifp_controller.php'; 

session_start();   

function check_post($param){
    $app = array();    
    foreach ($param as $key=>$value){
        if( $key == 'user' ){
            $app[$key] = sanitaze_input($value);
        }		
        else if( $key == 'password' ){
            $app[$key] = sanitaze_input($value);
        }
		else if( $key == 'email' ){
            $app[$key] = sanitaze_input($value);
        } 
    }
    return $app; 
}

if(isset($_GET['type'])){
	$type = $_GET['type'];
}else{
	$type = -1;
}

$smarty = new AIFP_smarty();
//di default assumo che non ci siano errori
$smarty->assign('error', '');
$contr = new aifp_controller();
if(isset($_SESSION['user'])){
    if(($post = check_post($_POST)) ){		
        $pwd = $post['password'];
        if(isset($post['email'])){
                $em = $post['email'];
                $token = $contr->login($pwd, $em, -1, $type);
        }else if(isset($post['user'])){
                $us = $post['user'];
                $token = $contr->login($pwd, -1, $us, $type);
        }
        if($token){
                session_start();
                $_SESSION['user']= $token;
                $us = aifp_controller::$collection_user[$token];
                $smarty->assign('user', $us->attributes['user'] );
                $smarty->display('index.tpl');
        }else{            
                $smarty->assign('error', $contr->descritpion);
                $smarty->display('index.tpl');
        }
    }else{
            $smarty->assign('error', GEN_ERROR);
            $smarty->display('index.tpl');
    }
}else{
	if(isset(aifp_controller::$collection_user[$_SESSION['user']])){
            $us = aifp_controller::$collection_user[$token];
            $smarty->assign('user', $us->attributes['user'] );
            $smarty->display('index.tpl');
        }else{
            session_destroy();
	}
}


  
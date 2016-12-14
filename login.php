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
            }else{            
                    $smarty->assign('error', $contr->descritpion);
                    $smarty->display('error.tpl');
            }
	}else{
		$smarty->assign('error', GEN_ERROR);
		$smarty->display('error.tpl');
	}
}else{
	if(isset(aifp_controller::$collection_user[$_SESSION['user']])){
		//messaggio di benventuo
        }else{
		session_destroy();
	}
}


  
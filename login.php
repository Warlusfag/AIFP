<?php
session_start();

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
$collection = unserialize($_SESSION['users']);

if(isset($_SESSION['curr_user'])){
    if( ($user = $collection->getitem($_SESSION['curr_user'])) ){
        $smarty->assign('user', $user->attributes['user'] );
        $smarty->assign('image', $user->attributes_descr['image']);
    }else{
        unset($_SESSION['curr_user']);
    }    
}else{
    if(($post = check_post($_POST)) ){		
        $pwd = $post['password'];
        if(isset($post['email'])){
            $em = $post['email'];
            $user = $contr->login($pwd, $em, -1, $post['type']);            
        }else if(isset($post['user'])){            
            $us = $post['user'];
            $user = $contr->login($pwd, -1, $us, $post['type']);            
        }
        if($user){
            $tok = $user->make_token();           
            if($collection->additem($user, $tok)){
                $_SESSION['curr_user'] = $tok;
                $_SESSION['users'] = serialize($collection);
                $smarty->assign('user', $user->attributes['user'] );
                $smarty->assign('image', $user->get_image());
            }else{
                $smarty->assign('user', $us->attributes['user'] );
            }
        }else{            
                $smarty->assign('error', $contr->descritpion);
        }
    }else{
            $smarty->assign('error', GEN_ERROR);
    }
}
$smarty->display('index.tpl');


  
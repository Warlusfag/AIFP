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

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
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
        if($user && $contr->description == ''){
            $_SESSION['curr_user'] = array();
            $tok = array($user->table_descr['key'] => $user->attributes[$user->table_descr['key']]);
            $_SESSION['curr_user']['token'] = $tok;
            $_SESSION['curr_user']['type'] =$user->type;
            $t = $user->get_attributes();
            $_SESSION['curr_user'] = array_merge($_SESSION['curr_user'],$t );           
            foreach($_SESSION['curr_user'] as $key=>$value){
                $t[$key] = $value;
            }
            $smarty->assign('profilo', $t );
        }else{            
            $smarty->assign('error', $contr->description);
        }
    }else{
        $smarty->assign('error', GEN_ERROR);
    }
}
if(isset($_SESSION['news'])){
    $new_col = unserialize($_SESSION['news']);
    $news = $new_col->get_all_news();
    $smarty->assign('news', $news );
}
$smarty->display('index.tpl');


  
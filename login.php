<?php

require_once 'libs/aifp_controller.php';    

function check_post($param){
    $app = array();    
    foreach ($param as $key=>$value){
        if( $key == 'user' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'password' ){
            $app[$key] = sanitaze_input($value);
        }           
    }
    return $app;
 
}
    
try{
    $smarty = new AIFP_smarty();
    $contr = new aifp_controller();

    if(check_post($_POST)){
        $em = $_POST['user'];
        $pwd = $_POST['password'];

        $user = $contr->select_user($em, $pwd);            

        if($user){
            session_start();
            $SESSION['user']= $user;
            $SESSION['ip']=$_SERVER['REMOTE_ADDR'];
            //codice per effettuare il login
            $smarty->assign();
            $smarty->display();
        }else{            
            $smarty->assign('error', $contr->descritpion);
            $smarty->display('error.tpl');
        }
    }
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');

} catch (Exception $ex){

    session_destroy();
    $smarty->assign('error', $ex->getMessage());
    $smarty->display('error.tpl');
}   
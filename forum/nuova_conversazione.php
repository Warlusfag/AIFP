<?php
require_once '../libs/aifp_controller.php';

session_start();

function check_post ($param)
{
    $app = array();
    $i = 0;
    foreach ($param as $key=>$value){
        if( $key == 'titolo' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'text' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'sezione' ){
            $app[$key] = $value;
            $i++;
        }
    }
    if($i == 3){
        return $app;
    }else{
        return false;
    }
}

$smarty = new AIFP_smarty();

if(isset($_SESSION['user'])){
    $tok = $_SESSION['user'];    
    $user = aifp_controller::$collection_user[$tok];
    if(($post=check_post($_POST))){ 
        $s = $post['sezione'];
        $sez = aifp_controller::$collection_sez[$s];        
        
        $text = $post['text'];
        $title = $post['titolo'];
        $us = array(
            'user' => $user->attributes['user'],
            'image'=> $user->attributes_descr['image'],
            'punteggio'=>$user->attributes_descr['punteggio'],
        );        
        if($sez->new_conversazione($us, $text, $title)){
            $smarty->assign('sezione', $s);
            $smarty->assign('message','Nuova conversazione aggiunta con successo');    
        }else{
            $smarty->assign('error',GEN_ERROR);        
        }
    }else{
        $smarty->assign('error','BAD parameters');        
    }
    $smarty->display('sezione.tpl');
}else{
    $smarty->display('login.tpl');
}


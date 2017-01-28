<?php

require_once '../libs/aifp_controller.php';
session_start();
function check_post ($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'conversazione' ){
            $app[$key] = $value;
        }
        else if( $key == 'text' ){
            $app[$key] = $value;
        }
        else if( $key == 'sezione' ){
            $app[$key] = $value;
        }
        else if( $key == 'pagina' ){
            $app[$key] = $value;
        }
    }
    return $app;
}
if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}
$smarty = new AIFP_smarty();

if (isset($_SESSION['user'])){
    $tok = $_SESSION['user'];
    $user = aifp_controller::$collection_user[$tok];    
    if (($post = check_post($_POST))){
        $s = $post['sezione'];
        $sez = aifp_controller::$collection_sez[$s];
        $page = $_GET['page'];
        if(isset($sez->convs[$page][$c])){
            $conv = $sez->convs[$page][$c];            
        }else{
            $smarty->assign('error',GEN_ERROR);
        }
        $us = array(
            'user' => $user->attributes['user'],
            'image'=> $user->attributes_descr['image'],
            'punteggio'=>$user->attributes_descr['punteggio'],
        );         
        $post = new post();
        if($post->new_post($post['text'], $us, $conv->attributes['key'])){
            $smarty->assign('sezione', $s);
            $smarty->assign('conversazione',$c);
            $smarty->assign('message','Post caricato con successo');                    
        }else{
            $smarty->assign('error',GEN_ERROR);
        }        
    }else{
        $smarty->assign('error','BAD parameters');        
    }
    $smarty->display('rispondi.tpl');
}else{
    $smarty->display('index.tpl');
}

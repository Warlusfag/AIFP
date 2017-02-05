<?php
session_start();
require_once '../libs/aifp_controller.php';

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

$smarty = new AIFP_smarty();

if(isset($_SESSION['curr_user'])){
    $tok = $_SESSION['curr_user']['token'];    
    $user = $contr->get_user($tok);
    
    if (($post = check_post($_POST))){
        $coll_c = unserialize($_SESSION['convs']);
        $s = $_POST['sezione'];
        $c = $_POST['conversazione'];
        $cpage = $_POST['page_conv'];

        $t = $coll_c->getitem($cpage);
        $attr = $t[$c];
        $conv = new conversazione();
        $conv->init($attr);
        $us = array(
            'user' => $user->attributes['user'],
            'image'=> $user->attributes_descr['image'],
            'punteggio'=>$user->attributes_descr['punteggio'],
        );     
        $conv->add_post($post['text'], $us);
        if($conv->err_descr == ''){
            $smarty->assign('sezione', $s);
            $smarty->assign('conversazione',$c);
            $smarty->assign('message','Post caricato con successo');  
        }else{
            $smarty->assign('error',$conv->err_descr);
        }        
    }else{
        $smarty->assign('error','BAD parameters');        
    }
    $smarty->display('rispondi.tpl');
}else{
    $smarty->display('index.tpl');
}

<?php
session_start();
require_once 'libs/aifp_controller.php';
function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'email' ){
            $app[$key] = $value;
        }
        else if( $key == 'testo' ){
            $app[$key] = $value;
        }
        else if( $key == 'nome' ){
            $app[$key] = $value;
        }
    }
    return $app;
}
$smarty = new AIFP_smarty();
$contr = new aifp_controller();
if( ($post = check_post($_POST)) ){
   
    $emails = $contr->lettera_esperto($post['email'], $post['nome'],$post['testo']);
    if(!is_array($emails)){
        $smarty->assign('error',$contr->description);
    }else{
        //code for send email
        $smarty->assign('message','La tua richiesta è stata spedita agli esperti del nostri sito con successo.\n Grazie per aver usato questo servizio');
   }
}
if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
if(isset($_SESSION['news'])){
    $new_col = unserialize($_SESSION['news']);
    $news = $new_col->get_all_news();
    $smarty->assign('news', $news );
}
if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$smarty->display('lettera_esperto.tpl');
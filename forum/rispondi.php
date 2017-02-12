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

if(isset($_POST['page_conv'])){
    $cpage = $_POST['page_conv'];
}else{
    $cpage = 0;
}

$smarty = new AIFP_smarty();
$contr = new aifp_controller();

if(isset($_SESSION['curr_user'])){
    $tok = $_SESSION['curr_user']['token'];    
    $user = $contr->get_user($tok);
    
    if (($post = check_post($_POST))){
        $coll_c = unserialize($_SESSION['convs']);
        $tito_sez = $_POST['sezione'];
        $tito_conv = $_POST['conversazione'];
        $c = $_POST['c_index'];
        $s = $_POST['s_index'];       

        $t = $coll_c->getitem($cpage);
        $attr = $t[$c];
        $conv = new conversazione();
        $conv->init($attr);
    
        $conv->add_post($post['text'], $user);
        if($conv->err_descr == ''){
            $smarty->assign('s_index', $s);
            $smarty->assign('c_index',$c);
            $smarty->assign('conversazione',$tito_conv);
            $smarty->assign('sezione',$tito_sez);
            $smarty->assign('message','Post caricato con successo');  
        }else{
            $smarty->assign('error',$conv->err_descr);
        }        
    }else{
        $smarty->assign('error','BAD parameters');        
    }
    $smarty->display('conversazione.tpl');
}else{
    $smarty->display('index.tpl');
}

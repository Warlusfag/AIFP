<?php

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}

if(isset($_POST['sezione']) && isset($_POST['conversazione']))
{   
    $s = $_POST['sezione'];
    $c = $_POST['conversazione'];
    if(isset(aifp_controller::$collection_sez[$i])){
        $sez = aifp_controller::$collection_sez[$i];
        $page = $_GET['page'];
        if(isset($sez->convs[$page][$c])){
            $conv = $sez->convs[$page][$c];            
        }else{
            $smarty->assign('error',GEN_ERROR);
        }
    }else{
        //le sezioni devono essere tutte caricate
        $smarty->assign('error',GEN_ERROR);
    }   
    if($conv->load_post($page)){
        $posts = $conv->show_posts($page);
        $smarty->assign('sezione',$s);
        $smarty->assign('conversazione',$c);
        $smarty->assign('posts', $posts);
    }else{
        $smarty->assign('error',$conv->err_descr);        
    }   
}else{
    $smarty->assign('error',GEN_ERROR);    
}

<?php

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}

if(isset($_POST['sezione']) && $_POST['conversazione'])
{   
    $id_sez = $_POST['sezione'];
    $id_conv = $_POST['conversazione'];
    $sez = aifp_controller::$collection_sez[$id_sez];
    $conv = $sez->convs[$id_conv];
    
    if($conv->load_post($page)){
        $posts = $conv->show_posts($page);
        $smarty->assign($posts);
        //smarty display        
    }else{
        $smarty->assign('error',GEN_ERROR);
        $smarty->display('error.tpl');
    }   
}else{
    $smarty->assign('error',GEN_ERROR);
    $smarty->display('error.tpl');    
}

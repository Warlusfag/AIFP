<?php

require_once 'libs/aifp_controller.php';

$smarty = new AIFP_smarty();

if(isset($_GET['page'])){
    $page = $_GET['page'];    
}else{
    $page = 1;
}

if(isset($_POST['sezione']) && $_POST['conversazione'])
{   
    $id_sez = $_POST['sezione'];
    if(isset(aifp_controller::$collection_sez[$id_sez])){
        $sez = aifp_controller::$collection_sez[$id_sez];
        if(count($sez->convs)==0){
            $convs= $sez->load_convs();        
        }else{
            $convs = $sez->convs;
        }
        
        if(isset($convs[$_POST['conversazione']])){
            $c = $convs[$_POST['conversazione']];
            if(count($c->posts)==0){
                $c->load_posts($page);                
            }
            $posts = $c->posts;            
           
        }       
        
    }
    
    
    
    $smarty->assign('post',$posts);
    $smarty->assign('utenti',$users);
    $smarty->display('sezione.tpl');    
}
else
{
    $smarty->assign('error','Internal server error');
    $smarty->display('error.tpl');    
}

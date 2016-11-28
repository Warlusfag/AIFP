<?php
require_once 'libs/aifp_controller.php';

session_start();

function check_post ($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'titolo' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'text' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'sezione' ){
            $app[$key] = sanitaze_input($value);
        }
    }
    return $app;
}

$smarty = new AIFP_smarty();

if(isset($_SESSION['user']))
{
    $tok = $_SESSION['user'];
    $user = aifp_controller::$collection_user[$tok];
    if(($post=check_post($_POST))){
        
        $sez = aifp_controller::$collection_sez[$post['sezione']];        
        
        $text = $post['text'];
        $title = $post['titolo'];
        $us = $user->attributes['user'];        
        
        if($sez->new_conversazione($us, $text, $title))
        {
            //Codice dell'avenuta aggiunta della conversazione            
        }
        else
        {
            $smarty->assign('error',GEN_ERROR);
            $smarty->display('error.tpl');        
        }
    }else{
        $smarty->assign('error','POST array is setted in bad way');
        $smarty->display('error.tpl');
    }    
}
else
{
    //codice per far effettura il login e il reindirizzamento    
}


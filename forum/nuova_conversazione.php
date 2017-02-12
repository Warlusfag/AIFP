<?php
session_start();

require_once '../libs/aifp_controller.php';

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
$controller = new aifp_controller();

if(isset($_SESSION['curr_user'])){
    $tok = $_SESSION['curr_user']['token'];    
    $user = $controller->get_user($tok);
    if(($post=check_post($_POST))){ 
        $s = $post['sezione'];
        $coll_s = unserialize($_SESSION['forum']);
        $t = $coll_s->getitem($s);
        $sez = new sezione();
        $sez->init($t);
        
        $text = $post['text'];
        $title = $post['titolo'];
        if($sez->add_conversazione($user, $text, $title)){
            //cancello convs così forzo il refresh
            $coll_s->updateitem($s, $sez->get_attributes());
            $_SESSION['curr_user']['punteggio'] = $user->get_attributes('punteggio');
            $_SESSION['curr_user']['num_post']= $user->get_attributes('num_post');
            $_SESSION['sezione'] = serialize($coll_s);
            $coll_c = unserialize($_SESSION['convs']);
            $coll_c->erase();
            $convs = $sez->get_conversazioni();           
            $smarty->assign('convs', $convs);
            $smarty->assign('sezione', $s);
            $smarty->assign('message','Nuova conversazione aggiunta con successo!');
        }else{
            $smarty->assign('error',GEN_ERROR);        
        }
    }else{
        $smarty->assign('error','BAD parameters');        
    }
    foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );
    $smarty->display('sezione.tpl');
}else{
    $smarty->display('index.tpl');
}


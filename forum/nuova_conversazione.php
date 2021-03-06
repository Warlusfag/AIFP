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
    }
    if($i == 2){
        return $app;
    }else{
        return false;
    }
}

$smarty = new AIFP_smarty();
$controller = new aifp_controller();

$user = $controller->get_us_from_type($_SESSION['curr_user']['type']);
$user->init($_SESSION['curr_user']);

if(($post=check_post($_POST))){ 
    $s = $_POST['s_index'];
    $titolo = $_POST['sezione'];
    $coll_s = unserialize($_SESSION['forum']);
    $t = $coll_s->getitem($s);
    $sez = new sezione();
    $sez->init($t);

    $text = $post['text'];
    $title = $post['titolo'];
    if($sez->add_conversazione($user, $title, $text)){
        //cancello convs così forzo il refresh
        $coll_s->updateitem($s, $sez->get_attributes());
        $_SESSION['sezione'] = serialize($coll_s);
        $coll_c = unserialize($_SESSION['convs']);
        $coll_c->erase();
        $convs = $sez->get_conversazioni();
        $coll_c->additem($convs, 0);
        $_SESSION['convs'] = serialize($coll_c);
        $smarty->assign('convs', $convs);
        $smarty->assign('message','Nuova conversazione aggiunta con successo!');
    }else{
        $smarty->assign('error',$sez->err_descr);        
    }
}else{
    $smarty->assign('error','BAD parameters');        
}

$smarty->assign('s_index', $s);
$smarty->assign('sezione', $titolo);

$_SESSION['curr_user']['punteggio'] = $user->attributes['punteggio'];
$_SESSION['curr_user']['num_post']= $user->attributes['num_post'];
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );

$smarty->display('sezione.tpl');



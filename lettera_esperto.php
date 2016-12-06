<?php

require_once 'libs/aifp_controller.php';

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'email' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'testo' ){
            $app[$key] = sanitaze_input($value);
        }
        else if( $key == 'nome' ){
            $app[$key] = sanitaze_input($value);
        }
    }
    return $app;
}

$smarty = new AIFP_smarty();

if( ($post = check_post($_POST)) ){
    $params = array(
        'esperto' => 1,
    );    
    $list_user = search_OnAll_descr_user($parmas, 20);
    if($list_user){
        $emails = array();
        $i=0;
        foreach($list_user as $value){
            foreach($value as $key=>$id){
                $p = array($key => $id);
                break;
            }
            $u=search_OnAll_users($p);
            $emails[$i] = $u['email'];
            $i++;
        }
        
    }else{
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');        
    }    
    $testo=$param['testo'];
    $nome=$param['nome'];
    $em=$param['email'];    
    $oggetto="AIFP: L\'utente '$nome' con email '$em' ha richiesto la consulenza di un esperto";
    
    foreach ($emails as $value) {
        mail($value, $oggetto, $testo);
    }

}else{
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');
}



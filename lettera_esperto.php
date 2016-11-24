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
$contr = new aifp_controller();

if( ($param = check_post($_POST)) ){
    
    $list_user = user::search_descr_user(-1, -1, -1, -1, -1, $esperto=1);
    if($list_user){
        $emails = array();
        foreach($list_user as $value){
            $t = user::get_table($value['type']);
            $k = user::get_key($value['type']);
            $user= user::search_user($table= $t, $id=$list_user[$k]);
            $emails[$i]=$user['email'];
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



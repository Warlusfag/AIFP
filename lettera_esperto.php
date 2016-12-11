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

if( ($post = check_post($_POST)) ){
    $params = array(
        'esperto' => 1,
    );    
    $list_user = search_OnAll_descr_user($parmas, 20);
    if($list_user){
        $emails = array();
        $i=0;
        foreach($list_user as $value){
            //prendo solamente il primo perché ho bisogno della chiamata
            foreach($value as $key=>$id){
                $p = array($key => $id);
                break;
            }
            $u=  $contr->search_OnAll_users($p);
            $emails[$i] = $u['email'];
            $i++;
        }        
    }else{
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');        
    }       
    $oggetto="AIFP: L\'utente $post[nome] con email $post[email] ha richiesto la consulenza di un esperto";
    
    foreach ($emails as $value) {
        mail($value, $oggetto, $testo);
    }
    $type = array(
        0 => 's',
        1 => 's',
        2 => 's',
    );
    $name = array_keys($post);
    $value = array_values($post);
    $db = new db_interface();    
    if(!$db->insert_statement('lettera_esperto',$value,$name,$type)){
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');
    }else{
        //successo
    }
}else{
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');
}



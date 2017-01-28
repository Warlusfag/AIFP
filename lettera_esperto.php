<?php

require_once 'libs/aifp_controller.php';

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'email' ){
            $app[$key] = $value;
        }
        else if( $key == 'testo' ){
            $app[$key] = $value;
        }
        else if( $key == 'nome' ){
            $app[$key] = $value;
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
    $list_user = $contr->search_OnAll_descr_users($params, 20);
    if($contr->descritpion == ''){
        $emails = array();
        $i=0;
        foreach($list_user as $value){
            foreach($value as $k){
                if(is_string($k) ){
                    $user = $contr->get_user_from_pkey($k);
                    if(is_object($user)){
                        $u =  $us->search_users($p);
                        $emails[$i] = $u['email'];
                        $i++;
                        
                    }
                }
            }
            
        }        
    }else{
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');        
    }       
    $oggetto="AIFP: L\'utente $post[nome] con email $post[email] ha richiesto la consulenza di un esperto";
    /* La parte dell'invio delle email va commentata
    foreach ($emails as $value) {
        mail($value, $oggetto, $testo);
    }
     * */
     
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
    }else{
        $smarty->assign('message','La tua richiesta è stata inoltrata con successo ai esperti');
    }
}else{
    $smarty->assign('error', GEN_ERROR);    
}
$smarty->display('lettera_esperto.tpl');




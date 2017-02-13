<?php
session_start();
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
   
    $emails = $contr->lettera_esperto($post['email'], $post['nome'],$post['testo']);
    if($email == false){
        $smarty->assign('error',$contr->description);
    }else{
        //code for send email
        $smarty->assign('message','La tua richiesta è stata spedita agli esperti del nostri sito con successo.\n Grazie per aver usato questo servizio');
   }
}
if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
if(isset($_SESSION['news'])){}
    $new_col = unserialize($_SESSION['news']);
    $news = $new_col->get_all_news();
    $smarty->assign('news', $news );

$smarty->display('lettera_esperto.tpl');
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
        $smarty->assign('message','La tua richiesta è stata inoltrata con successo agli esperti');
    }

if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$new_col = unserialize($_SESSION['news']);
$news = $new_col->get_all_news();
$smarty->assign('news', $news );
$smarty->display('lettera_esperto.tpl');

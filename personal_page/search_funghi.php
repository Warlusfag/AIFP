<?php
session_start();

require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();
if (isset($_SESSION['inactivity']) && (time() - $_SESSION['inactivity'] > $expired)){    
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    $smarty->assign('sessione'," SESSIONE SCADUTA: troppo tempo senza un attivita'");
}
$_SESSION['inactivity'] = time();

if(!isset($_SESSION['curr_user'])){
    $smarty->assign('login',1);
    $smarty->display('index.tpl');
}

if (!isset($_SESSION['view'])){
    $_SESSION['view'] = 'funghi';
}
if (!isset($_SESSION['results'])){
    $_SESSION['results'] = array();
}

$fungo = new funghi();
 
if( ($type = $_SESSION['curr_user']['type']) == 'user' ){
    $smarty->assign('error',"ERROR: non sei autorizzato ad effettuare questo tipo di ricerca");
    unset($_SESSION['funghi']);
    unset($_SESSION['results']);
    $smarty->display('personal_page.tpl'); 
} 

if(isset($_POST['index'])){
    $flag = false;
    $ris = $_SESSION['results'];
    for($i=0;$i<count($ris);$i++){
        if($i == $_POST['index']){
            $flag = true;
            break;
        }
    }
    if($flag == false){
        $smarty->assign('error','Nessuna descrizione di questo fungo trovata');
    }else{
        $fungo = new funghi();
        $fungo->init($ris[$i]);
        $smarty->assign('descrizione',$fungo->get_attributes());
        $photos = $fungo->get_photos();
        $smarty->assign('foto',$photos);
    }
}else if(isset($_POST['reset'])){
    if($_SESSION['view'] != $fungo->table_descr['table']){   
        $fungo->set_view($_SESSION['view']);
        $fungo->reset_search();
        $_SESSION['view'] = $fungo->table_descr['table'];
        
    }else{
        unset($_SESSION['funghi']);
    }
    unset($_SESSION['results']);
}else{
    $username = $_SESSION['curr_user']['user'];   
    $params = array();
    foreach($_POST as $key=>$value){
        $params[$key] = $value;
    }    
    $_SESSION['view'] = $fungo->preapare_dynaimic_search($_SESSION['view'], $username);
    $fung = $fungo->search_funghi($params, 20);    
    if($fungo->err_descr != '' || !is_array($fung)){
        $smarty->assign('error',$fungo->err_descr);
        $fungo->reset_search();
        $_SESSION['view'] = $fungo->table_descr['table'];
        unset($_SESSION['results']);
    }else{
        if(count($fung)==0){
            $smarty->assign("error","Nessun risultato trovato, fare il reset della ricerca");            
        }
        $_SESSION['results'] = $fung;
        $smarty->assign('funghi',$fung);
    }       
}
foreach($_SESSION['curr_user'] as $key=>$value){
    $t[$key] = $value;
}
$smarty->assign('profilo', $t );
$smarty->assign('fsearch', 1 );
$smarty->display('personal_page.tpl');

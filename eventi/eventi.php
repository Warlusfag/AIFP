<?php
session_start();

require_once '../libs/aifp_controller.php';

if (!isset($_SESSION['news'])){
    $_SESSION['news'] = serialize(new news_collection());
}

function check_post($param)
{
    $app = array();
    foreach ($param as $key=>$value){
        if( $key == 'nome_evento' ){
            $app[$key] = $value;
        }
        else if( $key == 'indirizzo' ){
            $app[$key] =$value;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
        }
        else if( $key == 'provincia' ){
            $app[$key] =$value;
        }
        else if( $key == 'data_inizio' ){
            $app[$key] = $value;
        }
        else if( $key == 'data_fine' ){
            $app[$key] = $value;
        } 
    }
    return $app;  
}

$smarty = new AIFP_smarty();
if(isset($_POST) && count($_POST)>0){
    $ev = new evento();
    $events = $ev->search_eventi($post, -1, 20);
    if($ev->err_descr == ''){
        $smarty->assign('eventi',$events);	
    }else{
        $smarty->assign('error', $ev->err_descr);        
    }    
}else{
    $new_col = unserialize($_SESSION['news']);
    if(!$new_col->is_load()){
        $contr = new aifp_controller();
        $news = $contr->get_news();
        if($contr->description != ''){
            $smarty->assign('error', $contr->description);
        }
        $new_col->add_all_news($news);
        $_SESSION['news'] = serialize($new_col);
    }else{
        $news = $new_col->get_all_news();
    }
}
if(isset($_SESSION['curr_user'])){   
    foreach($_SESSION['curr_user'] as $key=>$value){
        $t[$key] = $value;
    }
    $smarty->assign('profilo', $t );    
}
$smarty->assign('eventi',$news);
$smarty->display('eventi.tpl'); 

   

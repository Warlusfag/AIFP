<?php
require_once '../libs/aifp_controller.php';
require_once '../libs/evento_model.php';

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
    $contr = new aifp_controller();

    $news = $contr->get_news();
    if($contr->descritpion == ''){
        $smarty->assign('news', $news);

    }else{
        $smarty->assign('error', $contr->descritpion);
    }
}
$smarty->display('eventi.tpl'); 

   

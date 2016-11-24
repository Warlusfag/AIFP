<?php

require_once 'libs/aifp_controller.php';

session_start();

function check_post($param)
{
    $app = array();
    try{
        foreach ($param as $key=>$value){
            if( $key == 'nome_evento' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'indirizzo' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'data_inizio' ){
                $app[$key] = sanitaze_input($value);
            }
            else if( $key == 'data_fine' ){
                $app[$key] = sanitaze_input($value);
            } 
        }
        return $app;
    }catch(Exception $ex){
        return null;
    }   
}

$smarty = new AIFP_smarty();

if($_SESSION['ip'] == $_SERVERS['REMOTE_ADDR']){
    
    if($_SESSION['user'] instanceof associazione ){

        $ass = $_SESSION['user'];

        if(($post = check_post($_POST))){          
            $param=array();
            $titolo=$post['nome_evento'];
            $indirizzo=$post['indirizzo'];
            $data_inizio=$post['data_inizio'];
            $data_fine=$post['data_fine'];

            $ass->add_evento($titolo, $indirizzo, $data_inizio, $data_fine);

            if($ass->isok != ''){
                $smarty->assign('error', $ass->isok);
                $smarty->display('error.tpl');
            }
            else{      
                //codice per la visualizzazione dell'evento aggiunto            
            }
        }    
    }
    else
    {
        session_destroy();
        $smarty->assign('error', GEN_ERROR);
        $smarty->display('error.tpl');
    }
}
else
{
    session_destroy();
    $smarty->assign('error', GEN_ERROR);
    $smarty->display('error.tpl');
}
    



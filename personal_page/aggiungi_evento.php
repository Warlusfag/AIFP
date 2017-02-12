<?php
session_start();

require_once '../libs/aifp_controller.php';

function check_post($param)
{
    $app = array();
    $i = 0;
    foreach ($param as $key=>$value){
        if( $key == 'nome' ){
            $app[$key] = $value;
            $i += 1;
        }
        else if( $key == 'indirizzo' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'regione' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'provincia' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'data_inizio' ){
            $app[$key] = $value;
            $i++;
        }
        else if( $key == 'data_fine' ){
            $app[$key] = $value;
            $i++;
        } 
    }
    if(i == 6){
        return $app;  
    }else{
        return null;
    }
}

$smarty = new AIFP_smarty();
$c = new aifp_controller();

if(isset($_SESSION['curr_user'])){    
    $tok = $_SESSION['curr_user']['token'];
    $t = $_SESSION['curr_user']['type'];        
    if( ($ass = $c->get_user($tok, $t)) ){   
        if(($post = check_post($_POST))){            

            if($ass->add_evento($post)){
                $smarty->assign('error', $ass->err_descr);
            }else{
                $smarty->assign('message', 'evento aggiunto con successo');                
            }
        }else{
            $smarty->assign('error', 'BAD parameters');
        }
        $smarty->assign('user', $user->attributes['user'] );
        $smarty->assign('image', $user->get_image());
        $smarty->assign('type', $user->type);
        $smarty->display('personal_page.tpl');
    }else{
        $smarty->assign('error', $ass->err_descr);
        $smarty->display('index.tpl');
    }
}

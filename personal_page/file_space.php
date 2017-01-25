<?php

require_once '../libs/aifp_controller.php';

session_start();

$smarty = new AIFP_smarty();

$tok = $_SESSIONS['user'];
$ass = aifp_controller::$collection_user[$tok];
if( $ass instanceof associazioni){           

    if(isset($_POST['filename'])){    

        if($_POST['action']=='delete'){
            $ass->delete_file($_POST['filename']);
        }
        else if($_POST['action']=='download'){
            $ass->download_file($_POST['filename']);            
        }
        else if ($_POST['action']=='upload'){
            if(isset($_FILES)){
                $ass->upload_file($_FILES);
            }
        }else{
            $smarty->assign('error',GEN_ERROR);
        }        
        if($ass->err_descr != ''){
            $smarty->assign('error',$ass->err_descr);
        }
    }else{
        $smarty->assign('error',GEN_ERROR);
    }
}else{
    session_destroy();
    $smarty->assign('error',GEN_ERROR);
}  
$smarty->display('file_space.tpl');

<?php

require_once 'libs/aifp_controller.php';

session_start();

$contr = new aifp_controllere();
$smarty = new AIFP_smarty();

if ($_SESSION['ip']==$_SERVER['REMOTE_ADDR']){
    if($_SESSION['user'] instanceof associazioni){
        
        $ass = $_SESSION['user'];        
        
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
            }        
            if($ass->isok != ''){
                $smarty->assign('error',$ass->isok);
                $smarty->display('error.tpl');
            }
        }else{
            $smarty->assign('error',GEN_ERROR);
            $smarty->display('error.tpl');
        }
    }else{
        session_destroy();
        $smarty->assign('error',GEN_ERROR);
        $smarty->display('error.tpl');
    }  
}else{
    session_destroy();
    $smarty->assign('error',GEN_ERROR);
    $smarty->display('error.tpl');
}
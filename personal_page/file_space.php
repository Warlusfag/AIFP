<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();

$tok = $_SESSIONS['user'];
if(isset($_SESSIONS['curr_user'])){
    $controller = new aifp_controller();
    $tok = $_SESSIONS['curr_user']['token'];
    $type = $_SESSIONS['curr_user']['type'];
    $ass = $controller->get_user($tok, $type);
}else{
    $ass = -1;    
}

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
        }else if ($_POST['action']=='show'){
            $path = FILE_ASS.$ass->attributes['id'].'/';
            $files = array();
            if(!(file_exists($path))){
                mkdir($path, 0777, true);
            }else{
                $temp = scandir($base_path);                
                foreach($temp as $i=>$file){
                    $files[$i] = array();
                    if($file == '.' || $file == '..'){
                        continue;
                    }
                    $files[$i][] = $base_path.$file;
                    $files[$i][] = filesize($base_path.$file);                    
                }
            }
            $smarty->assign('files',$files);
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
    unset($_SESSIONS['curr_user']);
    $smarty->assign('error',GEN_ERROR);
}  
$smarty->display('file_space.tpl');

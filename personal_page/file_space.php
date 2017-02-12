<?php
session_start();
require_once '../libs/aifp_controller.php';

$smarty = new AIFP_smarty();

$tok = $_SESSIONS['user'];
if(isset($_SESSIONS['curr_user'])){
    $controller = new aifp_controller();
    $tok = $_SESSIONS['curr_user']['token'];
    $type = $_SESSIONS['curr_user']['type'];
    $user = $controller->get_user($tok, $type);
}else{
    $user = -1;    
}
$grant = false;
if(! $user instanceof user){
    if($user instanceof associazione){
        $id_ass = $user->attributes[$ass->table_descr['key']];
        $ass = $user;
        $grant = true;
    }
    else if(isset($ass->attributes['associazione'])){
        $params = array('ID_ass' =>  $user->attributes['associazione']);
        $ass = $controller->get_user($params);
        $id_ass = $ass->attributes[$ass->table_descr['key']];
    }
    if(isset($_POST['filename'])){
        if($_POST['action']=='delete'){
            if($grant == false){
                $smarty->assign('error',"Non hai permessi per cancellare i file");
            }else{
                $ass->delete_file($_POST['filename']);
            }
        }
        else if($_POST['action']=='download'){
            $ass->download_file($_POST['filename']);            
        }
        else if ($_POST['action']=='upload'){
            if(isset($_FILES)){
                $ass->upload_file($_FILES);
            }
        }else if ($_POST['action']=='show'){
            $path = FILE_ASS.$id_ass.'/';
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
                    $files[$i][] = str_replace(PROJ_DIR, '', $base_path.$file);
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

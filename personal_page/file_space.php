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

function formatSize( $bytes )
{
    $types = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
            return( round( $bytes, 2 ) . " " . $types[$i] );
}

function show_files($path) {
    $files = array();
    if (!(file_exists($path))) {
        if (!mkdir($path)) {
            return false;
        }
    } else {
        $temp = scandir($path);
        $i = 0;
        foreach (array_values($temp) as  $file) {            
            if ($file == '.' || $file == '..') {
                continue;
            }
            $files[$i] = array();
            $size = formatSize(filesize($path . $file));            
            $files[$i]['nome'] =  $file;
            $files[$i]['size'] = $size;
            $i++;
        }        
    }
    return $files;
}

$controller = new aifp_controller();

$type = $_SESSION['curr_user']['type'];
$user = $controller->get_us_from_type($type);
$user->init($_SESSION['curr_user']);
$grant = false;

if (!$user instanceof user || !$user instanceof admin) {
    if ($user instanceof associazione) {
        $id_ass = $user->attributes[$user->table_descr['key']];
        $ass = $user;
        $grant = true;
    } else if (isset($ass->attributes['associazione'])) {
        $params = array('ID_ass' => $user->attributes['associazione']);
        $ass = $controller->get_user($params, 'associazione');
        $id_ass = $ass->attributes[$ass->table_descr['key']];
    }
    $path = FILE_ASS . $id_ass . '/';
    if ($_POST['action'] == 'delete') {
        if ($grant == false) {
            $smarty->assign('error', "Non hai permessi per cancellare i file");
        } else {
            $ass->delete_file($_POST['filename']);
            if ($ass->err_descr != '') {
                $smarty->assign('error', $ass->err_descr);
            } else {
                $smarty->assign('message', 'File cancellato con successo');
            }
        }
    } else if ($_POST['action'] == 'download') {
        $p = $ass->download_file($_POST['filename']);
        if ($ass->err_descr != '') {
            $smarty->assign('error', $ass->err_descr);
        } else {
            $smarty->assign('path', str_replace(PROJ_DIR, '', $p));
        }
    } else if ($_POST['action'] == 'upload') {
        if ( isset($_FILES) && $_FILES['fileass']['error']== 0) {
            $file_descr = $_FILES['fileass'];           
            $ass->upload_file($file_descr);
            if ($ass->err_descr != '') {
                $smarty->assign('error', $ass->err_descr);
            } else {
                $smarty->assign('message', 'File aggiunto con successo');
            }
        }else{
            $smarty->assign('error',"ERROR: il file non e' stato caricato corretamente");
        }
    }
    $files = show_files($path);
    $smarty->assign('files', $files);

} else {
    $smarty->assign('error', "ERROR: non sei autorizzato ad effettuare quest'azione");
}
foreach ($_SESSION['curr_user'] as $key => $value) {
    $t[$key] = $value;
}
$smarty->assign('profilo', $t);
$smarty->assign('fspace', 1);
$smarty->display('personal_page.tpl');
    
<?php

session_start();

require_once '../libs/aifp_controller.php';

function show_files($path) {
    $files = array();
    if (!(file_exists($path))) {
        if (!mkdir($path)) {
            return false;
        }
    } else {
        $temp = scandir($path);
        foreach ($temp as $i => $file) {
            $files[$i] = array();
            if ($file == '.' || $file == '..') {
                continue;
            }
            $files[$i][] = str_replace(PROJ_DIR, '', $path . $file);
            $files[$i][] = filesize($path . $file);
        }        
    }
    return $files;
}

$smarty = new AIFP_smarty();
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
                $files = show_files($path);
                $smarty->assign('files', $files);
                $smarty->assign('message', 'File cancellato con successo');
            }
        }
    } else if ($_POST['action'] == 'download') {
        $path = $ass->download_file($_POST['filename']);
        if ($ass->err_descr != '') {
            $smarty->assign('error', $ass->err_descr);
        } else {
            $files = show_files($path);
            $smarty->assign('files', $files);
            $smarty->assign('path', str_replace(PROJ_DIR, '', $path));
        }
    } else if ($_POST['action'] == 'upload') {
        if (isset($_FILES)) {
            $ass->upload_file($_FILES);
            if ($ass->err_descr != '') {
                $smarty->assign('error', $ass->err_descr);
            } else {
                $smarty->assign('message', 'File aggiunto con successo');
                $files = show_files($path);
                $smarty->assign('files', $files);
            }
        }
    } else if ($_POST['action'] == 'show') {
        $files = show_files($path);
        $smarty->assign('files', $files);
    } else {
        $smarty->assign('error', GEN_ERROR);
    }
} else {
    $smarty->assign('error', "ERROR: non sei autorizzato ad effettuare quest'azione");
}
foreach ($_SESSION['curr_user'] as $key => $value) {
    $t[$key] = $value;
}
$smarty->assign('profilo', $t);
$smarty->display('personal_page.tpl');
    
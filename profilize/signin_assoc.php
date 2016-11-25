<?php

require_once 'libs/db_interface.php';

function check_post($post)
{
    return true;

}
$smarty = new AIFP_smarty();
$db = new db_interface();

if ($db->$status == false)
{
    $smarty->assign('error', $db->$description);
    $smarty->display('error.tpl');
}
else
{    
    if(check_post($_POST))
    {
        $db->add_request_ass($_POST);
        if (!$db->$status)
        {
            $smarty->assign('error', $db->$description);
            $smarty->display('error.tpl');    
        }
        //Codice per la visualizzazione della pagina della richiesta di registrazione
        //che è stata inoltrata
    }
    else 
    {
       $smarty->assign('error', 'Not all the fields sent are right');
       $smarty->display('error.tpl');        
    }    
}
    
    



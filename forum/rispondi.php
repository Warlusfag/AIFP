<?php

require_once 'libs/aifp_controller.php';
session_start();
$db = new aifp_controller();
$smarty = new AIFP_smarty();

if (isset($_SESSION['user']))
{
    if ($_POST['conversazione'] && $_POST['text'])
    {
        $db->add_post($_POST['conversazione'], $_SESSION['user'], $_POST['text']);
        if(!$db->$status)
        {
            $smarty->assign('error',$db->$error);
            $smarty->display('error.tpl');
        }
        else
        {
                //codice per messaggio dell'eventuale successo
        }
    }
    else
    {
        $smarty->assign('error','POST array is setted in bad way');
        $smarty->display('error.tpl');
    }
}
else
{
	//codice per far effettura il login e il reindirizzamento
}


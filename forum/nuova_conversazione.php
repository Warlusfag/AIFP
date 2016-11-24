<?php
require_once 'libs/db_interface.php';

function check_post ($post)
{
    
}

$db = new db_interface();
$smarty = new AIFP_smarty();

if(isset($_SESSION['user']))
{
    if(check_post($_POST))        
    {
        $ass = $_POST['associazione'];
        $text = $_POST['testo'];
        $title = $_POST['titolo'];
        if($db->add_conversazione($_SESSION['user'], $ass, $testo, $title))
        {
            //Codice dell'avenuta aggiunta della conversazione            
        }
        else
        {
            $smarty->assign('error',$db->$error);
            $smarty->display('error.tpl');        
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


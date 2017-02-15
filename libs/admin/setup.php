<?php

$server_root = "/srv/www/AIFP/";
$expired = 1800;

//constanti per la gestione del sito
define('PROJ_DIR', $server_root);
define('IMAGE', PROJ_DIR.'images/');
define('PROJ_LIBS',PROJ_DIR.'libs/');
define('PROJ_ADMIN', PROJ_LIBS.'admin/');
//IMMAGINI
define('IMG_USER', IMAGE.'image_user/');
define('DEFAULT_IMG', IMAGE.'default.png');
define('IMG_MUSH', PROJ_DIR.'funghi/image_funghi/');
define('IMG_PLANT',PROJ_DIR.'piante/image_piante/');
//DILE SPACE ASSOCIAZIONE
define('FILE_ASS', PROJ_DIR.'filespace_ass/');
//GENERAL ERROR
define('GEN_ERROR','Internal problem if persist, please contact the system administrator: g.faggioni5@gmail.com and gianmarcotroiano@gmail.com');

//ini_set('include_path', PROJ_ADMIN.'smarty/libs');
require_once(PROJ_ADMIN.'smarty/Smarty.class.php');

class AIFP_smarty extends Smarty
{    
    function __construct()
    {
        parent::__construct();
        
        $this->setCacheDir(PROJ_DIR.'smarty/AIFP/cache/');
        $this->setConfigDir(PROJ_DIR.'smarty/AIFP/configs/');
        $this->setTemplateDir(PROJ_DIR.'smarty/AIFP/templates/');
        $this->setCompileDir(PROJ_DIR.'smarty/AIFP/templates_c/');
        
        //$this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->debugging = true;
        $this->error_reporting = 0;
        
    }
    
    function global_variable(){
        $this->assign('error', '');
    }
}





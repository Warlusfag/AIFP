<?php

//Constanti per la trasportabilità del sito su diverse piattaforme


$server_root = $_SESSION['proj_dir'];

date_default_timezone_set('UTC');

//constanti per la gestione del sito
define('PROJ_DIR', $server_root);
define('PROJ_LIBS',PROJ_DIR.'libs/');
define('PROJ_ADMIN', PROJ_LIBS.'admin/');
define('FILE_ASS', PROJ_LIBS.'fuser/filespace_ass/');
define('IMG_USER', PROJ_LIBS.'fuser/image_user/');
define('IMG_MUSH',PROJ_LIBS.'/imgage_funghi/');
define('DEFAULT_IMG', IMG_USER.'default.png');
define('GEN_ERROR','Internal problem if persist, please contact the system administrator: g.faggioni5@gmail.com');

//ini_set('include_path', PROJ_ADMIN.'smarty/libs');
require_once(PROJ_ADMIN.'smarty/Smarty.class.php');

class AIFP_smarty extends Smarty
{    
    function __construct()
    {
        parent::__construct();       
     
        $this->template_dir=PROJ_DIR.'smarty/AIFP/templates/';        
        $this->_cache_include =PROJ_DIR.'smarty/AIFP/cache/';     
        $this->compile_dir=PROJ_DIR.'smarty/AIFP/templates_c/';
        $this->config_dir=PROJ_DIR.'smarty/AIFP/configs/';
        
    }
}



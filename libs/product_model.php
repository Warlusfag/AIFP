<?php
require_once 'admin/utils.php';
require_once 'admin/db_interface.php';

class prodotti extends gen_model{
    
    public  $type;
    
    function __construct(){
        
        parent::__construct();
        
        $this->table_descr = array(        
            'table' => 'prodotti',
            'key' => 'id_prod',
            'key_type' => 'i',
            'column_name' => 'nome,tipologia,descrizione',            
            'column_type' => 's,s,s',
        );
        
        $this->attributes=array(
            'id_prod' => -1,
            'nome' => '',
            'tipologia' => 'generale',
            'descrizione' => '',
        );
        
        $this->type=$this->attributes['tipologia'];
    }
    

      
}
    
class libri extends prodotti{
    
    function __construct() {
        parent::__construct();
        $this->attributes['tipologia'] = 'libri';
        $this->type = $this->attributes['tipologia'];
    }
    
    
}


<?php

require_once 'aifp_controller.php';

class funghi extends gen_model{
    
    public $queries;
    public $view_name;
    private $column_view;
            
    
    function __construct() {
        
        parent::__construct();
        
        $this->table_descr = array(
            'table' => 'funghi',
            'key' => 'id_fungo',
            'column_name' => '',
            'column_type' => '',
        );
        
        $this->view_name = '';
        
        $this->queries = array(
            'create' => "CREATE VIEW $this->view_name ($this->column_view) AS SELECT * FROM ? WHERE ",
            'drop' => "DROP VIEW $this->view_name ",
        );
        
    }
    
    public function insert_fungo($params){
        
    }
    
    private function generate_nameview($user){
        
    }
    
    public function search_funghi ($params, $limit = -1){
        
    }
    
    public function reset_search(){
        
    }
    
    public function load_image($path){
        
    }
    
}
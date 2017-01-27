<?php

require_once 'admin/setup.php';
require_once 'admin/utils.php';


class funghi extends gen_model{
    
    public $queries;
    //name attuale della view
    public $view_name;
    //name vecchia della view
    public $view_name_old;
    static public $generi= array(
            'ammanita',
            'boletus',
            'agaricus',
            'tricholoma',
            'clitocybe',
            'cantharrelus',
            'russula',
            'lactarius',           
        );
    private $column_view;
    private $column;           
    
    function __construct() {
        
        parent::__construct();
        
        $this->column='genere,specie,sporata,viraggio,lattice,cassante,cappello,cuticola_pelosità,cuticola_umidità,colore,imenio,attaccatura lamelle,anello,gambo,volva,pianta,habitat,foto1,foto2';
        
        $this->table_descr = array(
            'table' => 'funghi',
            'key' => 'id_fungo',
            'key_type' => 'i',
            'column_name' =>$this->column,
            'column_type' => 's,s,s,s,i,i,s,s,s,s,s,s,s,s,s,s,s,s,s',            
            'insert_column' => ',specie,sporata,viraggio,cappello,cuticola_pelosità,cuticola_umidità,colore,imenio,attaccatura lamelle,gambo,habitat',
        );        
        $this->column_view = 'genere,specie,sporata,viraggio,lattice,cassante,cappello,cuticola_pelosità,cuticola_umidità,colore,imenio,attaccatura lamelle,anello,gambo,volva,pianta,habitat,foto1,foto2';
      
        $this->queries = array(
            'create' => "CREATE VIEW %s (".$this->column_view.") AS SELECT * FROM %s WHERE ",
            'drop' => "DROP VIEW %s; ",
        );        
    }
    
    public function insert_fungo($params){
        $value = array();
        $keys = explode(',',$this->table_descr['column_name']);
        $i = 0;
        $type = explode(',',$this->table_descr['column_type']);
        foreach($keys as $key){
            if(isset($params[$key])){
                $value[$i] = $params[$key];
            }       
            $i++;            
        }
        if(!$this->conn->insert_statement($this->table_descr['table'],$keys, $value, $type)){
            $this->err_descr = $this->conn->error;
            return false;
        }else{
            $this->err_descr = '';
            return false;
        }
    }
    
    private function generate_nameview($user){
        $i = rand(0, 5000);
        $j = rand(0, 5000);
        return  md5($user.$i.$j);                
    }
    
    public function search_funghi($params, $user=-1, $limit = -1){
        if(!$this->conn->status){
            $this->conn = new db_interface();
            if(!$this->conn->status){
                $this->err_descr = $this->conn->error;
                return false;
            }
        }
        if($user == -1){
            $query = "SELECT * FROM ". $this->table_descr['table']." AS U ";
        }else{
            if(!isset($this->view_name)){
                $this->view_name_old = $this->table_descr['table'];            
            }else{$this->view_name_old = $this->view_name;}
            $this->view_name = $this->generate_nameview($user);
            $query = sprintf($this->queries['create'], $this->view_name, $this->view_name_old );
        }        
        if(count($params) > 0){             
            $column = explode(',', $this->table_descr['key'].','.$this->table_descr['column_name']);
            $c_type = explode(',', $this->table_descr['key_type'].','.$this->table_descr['column_type']);
            foreach( $column as $i => $key){
                if(isset($params[$key])){
                    if($c_type[$i] == 's'){
                        $query .= "U.$key='$params[$key]' AND ";                        
                    }else{
                        $query .= "U.$key=$params[$key] AND ";
                    }
                }
            }            
            $query = str_replace($query, '', count($query)-6);
        }else{ $this->err_descr = 'ERROR: no parameters'; return false;}
        
        if($limit > 0){
            $query .= " LIMIT $limit";            
        }  
        $query .= ";";
        
        $res = $this->conn->query($query);
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        if(($nr = $res->num_rows) >=0){
            $app=array();                
            for($j=0; $j<$nr; $j++){
                $res->data_seek($j);
                $app[$j]=$res->fetch_array(MYSQLI_BOTH);                
            }
            if($user != -1){
                $this->conn->query(sprintf($this->queries['drop'],$this->view_name_old));
                if(!$this->conn->status){
                    $this->err_descr = $this->conn->error;
                    return false;
                }
            }
            $this->err_descr = '';
            return $app;
        }else{                
            $this->err_descr=$this->conn->error;
            return false;
        }
    }
    
    public function reset_search(){
        if(isset($this->view_name)){            
            $query = sprintf($this->queries['drop'], $this->view_name);
            if(!$this->conn->status){
                $this->conn = new db_interface();
                if(!$this->conn->status){
                    return false;
                }
            }
            $this->conn->query($query);
            if($this->conn->status == false){
                $this->err_descr = $this->conn->error;
                return false;
            }else{
                $this->view_name = null;
                $this->err_descr = '';
                return true;
            }            
        }else{
            return true;
        }
    }    
}
<?php

require_once 'admin/setup.php';
require_once 'admin/utils.php';


class piante extends gen_model{
    
    public $queries;
    //name attuale della view
    public $view_name;
    //name vecchia della view
    public $view_name_old;
    static public $generi= array(
           0 => 'conifere',
           1 => 'fagacee',
           2 => 'rosacee',
           3 => 'orchidacee',
        );
    private $column_view;
    private $column;           
    
    function __construct() {
        
        parent::__construct();
        
        $this->column='';
        
        $this->table_descr = array(
            'table' => 'piante',
            'key' => 'id_pianta',
            'key_type' => 'i',
            'column_name' =>$this->column,
            'column_type' => 's,s,s,s,i,i,s,s,s,s,s,s,s,s,s,s,s,s,s',            
        );        
        $this->column_view = '';
      
        $this->queries = array(
            'create' => "CREATE VIEW %s (".$this->column_view.") AS SELECT * FROM %s AS U ",
            'drop' => "DROP VIEW %s; ",
            'select' => "SELECT * FROM %s AS U ",
        );        
    }
    
    public function preapare_dynaimic_search($name, $username){
        $this->view_name_old = $name;
        $this->view_name = $this->generate_nameview($username);
        return $this->view_name;
    }
    
    public function set_view($name){
        $this->view_name = $name;
    }
    
    private function generate_nameview($user){
        $i = rand(0, 5000);
        $j = rand(0, 5000);
        return  md5($user.$i.$j);                
    }
    
    public function insert_fungo($params){
        return $this->insert($params);
    }
    

    
    public function search_piante($params, $limit = -1){
        if(!$this->conn->status){
            $this->conn = new db_interface();
            if(!$this->conn->status){
                $this->err_descr = $this->conn->error;
                return false;
            }
        }
        if(isset($this->view_name) && isset($this->view_name_old)){
            $query = sprintf($this->queries['create'], $this->view_name, $this->view_name_old );         
        }else{            
            $query = sprintf($this->queries['select'], $this->table_descr['table']);
        }              
        if(count($params) > 0){
            $query .= " WHERE ";
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
            $query = substr_replace($query, '', count($query)-6);
        }
        else{
            //se non ci sono parametri devo limitare il numero dei risultati
            if($limit == -1){ $limit = 30;}
        }        
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
            if(isset($this->view_name) && isset($this->view_name_old)){
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


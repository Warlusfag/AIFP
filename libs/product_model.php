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
    
    public function search_prodotti($params, $limit=-1, $after=-1){
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                $this->err_descr = "ERROR: DB is not ready";
                return false;
            }
        }
        $query = "SELECT * FROM ". $this->table_descr['table'];
        if(count($params) > 0 || $after > 0){
            $query .= " AS U WHERE ";
            $column = explode(',', $this->table_descr['key'].','.$this->table_descr['column_name']);
            $c_type = explode(',', $this->table_descr['key_type'].','.$this->table_descr['column_type']);
            foreach( $column as $i => $key){
                if(isset($params[$key])){
                    if($c_type[$i] == 's'){
                        $query .= " U.$key='$params[$key]' AND ";                        
                    }else{
                        $query .= " U.$key=$params[$key] AND ";
                    }
                }
            }
            if($after > 0){
                $query .= "'".$this->table_descr['key']."'> $after AND ";
            }            
            $query = substr_replace($query, '', count($query)-6);
        }
        if($limit > 0){
            $query .= " LIMIT $limit";            
        }
        $query .= ';';
        
        $res = $this->conn->query($query);
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        if(($nr = $res->num_rows) >=0){
            $app=array();                
            for($j=0; $j<$nr; $j++){
                $res->data_seek($j);
                $app[$j]=$res->fetch_assoc();                
            }
            $this->err_descr = '';
            return $app;
        }
    }   
}
    
class libri extends prodotti{
    
    function __construct() {
        parent::__construct();
        $this->attributes['tipologia'] = 'libri';
        $this->type = $this->attributes['tipologia'];
    }
    
    
}


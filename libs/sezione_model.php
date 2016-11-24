<?php

require_once 'gen_model.php';
require_once 'admin/setup.php';


const limit_conv = 15;
const limit_page = 5;

class sezione extends gen_model{
    
    public $convs;
    
    function __construct(){
        parent::__construct(); 
        
        $this->attributes = array(
            'id_sez'=>-1,
            'nome' => '',
            'moderatore' => '',            
            'num_convs' => array(),            
        );
        
        $this->table_descr = array(
            'table' => 'sezioni',
            'key'=>'id_sez',
            'key_type'=>'i',
            'column_name' => 'id_sez,nome,moderatore,num_conv',
            'colimn_type' => 'i,s,s,i',
        );
        $this->convs = array();
        for($i=0;$i<limit_page;$i++){
            $this->convs[$i] = array();        
        }
        
    }
    
    public function init ($params){
        if(!is_array($params) && count($params)>0 ){
            return false;
        }
        foreach($this->attributes as $key=>$value){
            if(isset($params[$key])){
                $this->attributes[$key]=$params[$key];            
            }
        }
        return true;
    }
    
    public function load_conv ($page){
        if($this->attributes[$this->table_descr['key']]==-1){
            $this->err_descr = "ERROR: object is not initialized";
            return false;
        }
        require_once 'conversazione_model.php';
        $after = 0;
        if($page > 0){ 
            $after = $page*limit_conv;
            $page -= 1;            
        }
        $t = new conversazione();        
        $params = array(
            $t->table_descr['fk_sez'] => $this->attributes[$this->table_descr['key']],            
        );        
        $convs = $t->search_conversazioni($params, $after, limit_conv);
        if(!$t){
            $this->err_descr = GEN_ERROR;
            return false;
        }
        if(count($convs)>= limit_conv){
            $n = limit_conv;
        }else{
            $n = count($convs);
        }
        for($i=0;$i<$n;$i++){
            $t = new conversazione();
            $t->init($convs[$i]);
            $this->$convs[$page][$convs[$i][$t->table_descr['key']]] = $t;
        }
        return true;
    }    
    
    public function get_conversazioni($page){
        if($page > limit_page){
            $this->err_descr = "ERROR: page over the limit";
            return false;
        }
        if(!isset($this->convs[$page])){
            $this->err_descr = "ERROR: page selected is not right";
            return false;
        }
        $convs = array();
        for($i=0;$i<count($this->convs[$page]);$i++){
            $convs[$i] = $this->convs[$page]->attributes;
        }
        return $convs;
    }
    
    public function search_sezioni($params, $after = -1, $limit=-1){
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                $this->err_descr = "ERROR: DB is not ready";
                return false;
            }
        }
        $query = "SELECT * FROM $this->table_descr['table']";
        if(count($params) > 0 || $after > 0){
             $query .= " WHERE ";
            $column = explode(',', $this->table_descr['column_name']);
            foreach( $column as $key){
                if(isset($params[$key])){
                    $query .= $key."=".$params[$key]." AND ";
                }
            }
            if($after > 0){
                $query .= $this->table_descr['key']."> $after AND ";
            }            
            $query = str_replace($query, '', count($query)-6);
        }
        if($limit > 0){
            $query .= "LIMIT $limit;";            
        } else { $query .= ";";}
        
        $res = $this->conn->query($query);
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        if(($nr = $res->num_rows) >=1){
            $app=array();                
            for($j=0; $j<$nr; $j++){
                $res->data_seek($j);
                $app[$j]=$res->fetch_assoc();                
            }            
            return $app;
        }else{                
            $this->err_descr="ERROR: No results found \n ";
            return false;
        }      
    }
}
<?php

require_once 'associazione_model.php';
require_once 'sezione_model.php';
require_once 'product_model.php';
require_once 'admin/utils.php';


class admin extends user{
    
    public $table_descr_product;
    public $table_descr_assoc;
    public $table_descr_sez;    
    
    function __construct(){
        
        parent::__construct();
        $this->type = 'admin';
        
        $this->table_descr_assoc = array(        
            'table' => 'associazione',
            'table_descr' => 'descr_ass',            
            'key' => 'ID_ass',
            'column_name' => 'ID_ass,email,password,user,nome,regione,indirizzo,CAP',
            'column_descr' => 'ID_ass,sito_web,num_post,punteggio,componenti,esperto',
            'column_type' => 'i,s,s,s,s,s,s,s',
            'column_type_descr' => 'i,s,i,i,i,i',
        );
        
        $this->table_descr_product = array(        
            'table' => 'prodotti',
            'key' => 'id_prod',
            'column_name' => 'id_prod,nome,tipologia,descrizione',            
            'column_type' => 'i,s,s,s',
        );
        
        $this->table_descr_sez = array(        
            'table' => 'sezioni',
            'key'=>'id_sez',
            'key_type'=>'i',
            'column_name' => 'id_sez,nome,moderatore,num_conv',
            'colimn_type' => 'i,s,s,i',
        );        
    }
    
    public function register_assoc($id){        
        if(!$this->conn->status){
            $this->err_descr = "ERROR:DB is not ready";
            return false;
        }
        $key = $this->table_descr_assoc['key'];
        $query = "SELECT * FROM req_assoc WHERE $key=$id;";
        $ris = $this->conn->query($query);
        
        if(($n = $ris->num_rows)==1){
            $ris->data_seek(0);
            $param = $ris->fetch_array(MYSQLI_NUM);
        }else{
            $this->err_descr = 'ERROR: id value is not right';
            return false;
        }                       
        $name=  extract_node($this->table_descr_assoc['column_name'],0);
        $type = extract_node($this->table_descr_assoc['column_type'],0);
        $param = extract_node($param, 0);
        if(!$this->conn->statement_insert($this->table_descr_assoc['table'],$name,$param,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        //inserimento nella tabella descritpion
        $param_descr = array();
        $ass = new associazione();        
        $id = $this->conn->last_id;        
        $i=0;
        $name=  extract_node($this->table_descr_assoc['column_descr'],0);
        $type = extract_node($this->table_descr_assoc['column_type_descr'],0);
        foreach($ass->attributes_descr as $key=>$value){
            $param_descr[$i] = $value;
            $i++;            
        }
        $param_descr = extract_node($param_descr, 0);
        if(!$this->conn->statement_insert($this->table_descr_assoc['table_descr'],$name,$param_descr,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr='';
        return true;
        
    }
    
    public function show_req_assoc(){
        if(!$this->conn->status){
            return false;
        }
        $query = "SELECT * FROM req_assoc;";
        $ris = $this->conn->query($query);
        
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        if(($nr = $ris->num_rows) >=1){
            $app=array();                
            for($j=0; $j<$nr; $j++){
                $ris->data_seek($j);
                $app[$j]=$ris->fetch_assoc();                
            }            
            return $app;
        }else{                
            $this->err_descr="ERROR: No results found \n ";
            return false;
        }     
    }
    
    public function insert_section($params){
        if(!$this->conn->status){
            return false;
        }
        $name = extract_node($this->table_descr_sez['column_name'],0);
        $type = extract_node($this->table_descr_sez['type'], 0);
        
        if(!$this->conn->statement_insert($this->table_descr_sez['table_descr'],$name,$params,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr='';
        return true;
    }
    
    public function insert_product($params){
        if(!$this->conn->status){
            return false;
        }
        $name = extract_node($this->table_descr_product['column_name'],0);
        $type = extract_node($this->table_descr_product['type'], 0);
        
        if(!$this->conn->statement_insert($this->table_descr_product['table_descr'],$name,$params,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr='';
        return true;
    }
    
    public function move_post(){
        
    }
    
    public function delete_post(){}
    
}


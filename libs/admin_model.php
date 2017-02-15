<?php

require_once 'associazione_model.php';
require_once 'sezione_model.php';
require_once 'product_model.php';
require_once 'admin/utils.php';
require_once 'evento_model.php';
require_once 'conversazione_model.php';

class admin extends user{
    
    public $table_descr_product;
    public $table_descr_assoc;
    public $table_descr_sez;
    public $queries;
    
    function __construct(){
        
        parent::__construct();
        $this->type = 'admin';
       
        $this->table_descr=array(
            'table' =>'admin',            
            'key' =>'id_admin',
            'key_type'=>'i',
            'column_name'=>'email,password,user,nome,cognome,regione,residenza,data,num_post,punteggio,image,patentino,esperto',
            'column_type'=>'s,s,s,s,s,s,s,da,i,i,s,i,i',
        );
        
        $this->queries = array(
            'delete' => "DELETE FROM %s WHERE %s=%u",
            'insert_files'=> "INSERT INTO %s (%s) VALUES ('%u', '%u', '%s');",
            'select' => "SELECT * FROM %s AS U ",
        );
        
        $this->default_col = array(
            'user' => 'admin',
            'num_post' => 0,
            'punteggio' => 0,
            'image' => DEFAULT_IMG,
            'patentino' => 0,
            'esperto' => 0,
        );  
        
        $this->attributes = array(
            'id_admin' => -1,
            'email' => "",
            'password'=>"",
            'user' => $this->default_col['user'],
            'nome' => '',
            'cognome' => '',
            'regione' => "",
            'residenza' => "",
            'data'=>"",
            'num_post' => $this->default_col['num_post'],
            'punteggio' => $this->default_col['punteggio'],
            'image' => $this->default_col['image'],
            'patentino' => $this->default_col['patentino'],
            'esperto' => $this->default_col['esperto'],
        );               
    }
    
    public function register_assoc($associazione){        
        if(!$this->conn->status){
            $this->err_descr = "ERROR:DB is not ready";
            return false;
        }
        $ass = new associazione();
        $ass->insert($associazione);
        if($ass->err_descr != ''){
            $this->err_descr = $ass->err_descr;
            return false;
        }
        $key = $associazione[$ass->table_descr_req['key']];
        $table = $ass->table_descr_file['table'];
        $size = 0;
        $files = '';
        $names = $ass->table_descr_file['key'].','.$ass->table_descr_file['column_name'];
        $query = sprintf($this->queries['insert_files'],$table,$names,$key,$size,$files);
        $this->conn->query($query);
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }        
        $query_delete = sprintf($this->queries['delete'], $ass->table_descr_req['table'],$ass->table_descr['key'],$key);        
        $this->conn->query($query_delete);
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        $this->err_descr = '';
        return true;
    }
    
    public function show_req_assoc(){
        if(!$this->conn->status){
            return false;
        }
        $ass = new associazione();
        $query = sprintf($this->queries['select'],$ass->table_descr_req['table']);
        $query .= ";";
        $ris = $this->conn->query($query);
        
        if (!$this->conn->status){            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        if(($nr = $ris->num_rows) >=0){
            $app=array();                
            for($j=0; $j<$nr; $j++){
                $ris->data_seek($j);
                $app[$j]=$ris->fetch_array(MYSQLI_BOTH);                
            }            
            return $app;
        }     
    }
    
    public function insert_section($params){        
        $sezione = new sezione();        
        $sezione->insert($params);
        if($sezione->err_descr != ''){
            $this->err_descr = $sezione->err_descr;
            return false;
        }else{
            $this->err_descr = '';
            return true;
        }
    }
    
    public function insert_product($params){
        if(!$this->conn->status){
            return false;
        }
        $prodotti = new prodotti();
        $prodotti->insert($params);
        if($prodotti->err_descr != ''){
            $this->err_descr = $prodotti->err_descr;
            return false;
        }
        $this->err_descr = '';
        return true;
    }
    
    public function delete_post(){}
     
    
}


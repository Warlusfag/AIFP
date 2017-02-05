<?php

require_once 'gen_model.php';
require_once 'conversazione_model.php';
require_once 'admin/setup.php';

const limit_conv = 15;
const limit_page = 5;

class sezione extends gen_model{
    
    public $convs;
    //flag per verificare se c'è stato un inserimento di una converszione
    static public $inserted;
    
    function __construct(){
        parent::__construct(); 
        
        if(!isset(self::$inserted)){
            self::$inserted = true;            
        }
        $this->attributes = array(
            'id_sez'=>-1,
            'nome' => '',
            'moderatore' => '',            
            'num_conv' => -1,            
        );
        
        $this->table_descr = array(
            'table' => 'sezioni',
            'key'=>'id_sez',
            'key_type'=>'i',
            'column_name' => 'nome,moderatore,num_conv',
            'column_type' => 's,s,i',
        );
        $this->convs = array();        
    }
    
    public function init ($params){
        if(!is_array($params) && count($params)>0 ){
            return false;
        }
        foreach(array_keys($this->attributes) as $key){
            if(isset($params[$key])){
                $this->attributes[$key]=$params[$key];            
            }
        }
        $this->err_descr = '';
        return true;
    }
     
    public function get_conversazioni(){
        if($this->attributes[$this->table_descr['key']]==-1){
            $this->err_descr = "ERROR: object is not initialized";
            return false;
        }
        $t = new conversazione();        
        $params = array(
            'sezione' => $this->attributes[$this->table_descr['key']],            
        );        
        $convs = $t->search_conversazioni($params);
        if($t->err_descr != ''){
            $this->err_descr = $t->err_descr;
            return false;
        }               
        $this->err_descr = '';
        return $convs;
    }
        
    public function add_conversazione($user, $titolo, $text){
        $c = new conversazione();
        $c->new_conv($this->attributes[$this->table_descr['key']], $user, $titolo, $text);
        if($c->err_descr != ''){
            $this->err_descr = $c->err_descr;
            return false;
        }
        $this->attributes['num_conv']++;
        $this->err_descr = '';
        return true;
        /*$i = count($this->convs)-1;
        if(count($this->convs[$i]) < limit_conv){
            array_push($this->convs[$i], $c);
            $this->attributes['num_convs']++;
        }else{            
            if(count($this->convs) == limit_conv){
                $this->push_ahead_conv($c);
            }
        }
        self::$inserted = true;
        $this->err_descr = '';
        return true;*/
    }
    
    public function search_sezioni($params, $after = -1, $limit=-1){
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                $this->err_descr = "ERROR: DB is not ready";
                return false;
            }
        }
        $query = "SELECT * FROM ".$this->table_descr['table'];
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
            $this->err_descr = '';
            return $app;
        }
    }
    
    private function push_ahead_conv($c){
        $convs = array();
        $convs[0] = array();
        $convs[0][0]=$c;
        for($p=0;$p<limit_page;$p++){
            for($i=0;$i<limit_conv;$i++){
                if($i==limit_conv-1){
                    if($p < limit_page-1){
                        $convs[$p+1] = array();
                        $convs[$p+1][0] = $this->convs[$p][$i];
                    }
                }else{
                    $convs[$p][$i+1] = $this->convs[$p][$i];
                }
            }
        }
        $this->convs = $convs;
    }
}
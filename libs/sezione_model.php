<?php
if(!define(sezione)){
    require_once 'gen_model.php';
    require_once 'conversazione_model.php';
    require_once 'admin/setup.php';
    define('sezione',1);
}

const limit_conv = 15;
const limit_page = 5;

class sezione extends gen_model{
    
    public $convs;
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
            'num_convs' => -1,            
        );
        
        $this->table_descr = array(
            'table' => 'sezioni',
            'key'=>'id_sez',
            'key_type'=>'i',
            'column_name' => 'id_sez,nome,moderatore,num_conv',
            'colimn_type' => 'i,s,s,i',
        );
        $this->convs = array();        
    }
    
    public function init ($params){
        if(!is_array($params) && count($params)>0 ){
            return false;
        }
        if(count($this->attributes) != count($params)){
            $this->err_descr['ERROR: Input is not correct'];
            return false;
        }
        foreach($this->attributes as $key=>$value){
            if(isset($params[$key])){
                $this->attributes[$key]=$params[$key];            
            }
        }
        $this->err_descr = '';
        return true;
    }
     
    public function load_conv ($page){
        if($this->attributes[$this->table_descr['key']]==-1){
            $this->err_descr = "ERROR: object is not initialized";
            return false;
        }
        if($page > limit_conv){
            $this->err_descr = 'ERROR:page out of bound';
            return false;            
        }       
        //Codice per assicurare un corretto caricamento della pagina
        if(isset($this->convs[0])){
            if(count($this->convs) >= $page){
                $this->convs[$page] = array();
            }else if(count($this->convs) < $page || self::$inserted == false){
                return true;
            }
        }else{ $this->convs[0] = array();}
        
        $after = 0;
        if($page > 0){ 
            $after = $page*limit_conv;
            $page -= 1;
        }
        $t = new conversazione();        
        $params = array(
            $t->table_descr['sezione'] => $this->attributes[$this->table_descr['key']],            
        );        
        $convs = $t->search_conversazioni($params, $after, limit_conv);
        if(!$t){
            $this->err_descr = $t->err_descr;
            return false;
        }
        if(count($convs)> limit_conv){
            $n = limit_conv;
        }else{
            $n = count($convs);
        }
        for($i=0;$i<$n;$i++){
            $t = new conversazione();
            $t->init($convs[$i]);
            $this->$convs[$page][$i] = $t;
        }
        self::$inserted = false;
        $this->err_descr = '';
        return true;
    }    
    
    public function get_conversazioni($page){        
        if($page > limit_page){
            $this->err_descr = "ERROR: page over the limit";
            return false;
        }
        if($page <= 0){
            return false;
        }
        $page -= 1;
        if(!isset($this->convs[$page])){
            $this->err_descr = "ERROR: page selected is not right";
            return false;
        }
        $convs = array();
        for($i=0;$i<count($this->convs[$page]);$i++){
            $convs[$i] = extract_node($this->convs[$page]->attributes,0);
        }
        return $convs;
    }
    
    public function new_conversazione($user, $titolo, $text){
        $c = new conversazione();
        $c->new_conv($this->attributes[$this->table_descr['key']], $user, $titolo, $text);
        if($c->err_descr != ''){
            $this->err_descr = $c->err_descr;
            return false;
        }
        $i = count($this->convs)-1;
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
        return true;
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
            $query .= " LIMIT $limit;";            
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
            $this->err_descr = '';
            return $app;
        }else{                
            $this->err_descr="ERROR: No results found \n ";
            return false;
        }      
    }
    
    private function push_ahead_conv($c){
        $convs = array();
        $convs[0] = array();
        $convs[0][0]=$c;
        for($p=0;$p<limit_page;$p++){
            for($i=0;$i<limit_conv;$i++){
                if($i==limit_conv-1){
                    if($p != limit_page){
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
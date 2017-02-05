<?php

const limit_post = 10;

class conversazione extends gen_model
{
    public $posts;
    static public $inserted;
    
    function __construct($id=-1, $titolo=-1){
        parent::__construct();
        
        if(!isset(self::$inserted)){
            self::$inserted = true;
        }        
        $this->attributes = array(
            'id_conv'=>-1,
            'sezione' => -1,
            'titolo' => 'titolo',            
            'num_post' => 1,
            'data' => '0-0-0000',
        );        
        $this->table_descr = array(
            'table' => 'conversazioni',
            'key'=>'id_conv',
            'key_type'=>'i',
            'column_name' => 'sezione,titolo,num_post,data',
            'column_type' => 'i,s,i,i,t',
        );        
        $this->posts = array();
        
        if($id != -1 || $titolo != -1){
            if($id != -1 ){
                $params = array(
                    $this->table_descr['key'] => $id,
                );            
            } else if($titolo!=-1 ){
                $params = array (
                    'titolo' => $titolo,
                );
            }
            $conv = $this->search_conversazioni($params);
            $this->init($conv[0]);
        }
    }
    
    public function init ($params){
        if(!is_array($params) && count($params) == 0 ){
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
    
    public function new_conv($fk_sez, $user, $titolo, $text){
        if(!$this->conn->status){
            $this->conn = new db_interface();
            if(!$this->conn->status){
                $this->err_descr = $this->conn->error;
                return false;
            }
        }
        $this->attributes['sezione'] = $fk_sez;
        $this->attributes['titolo'] = $titolo;
        
        $name = $this->table_descr['column_name'];
        $type = $this->table_descr['column_type'];
        $value = array(
            0 => $this->attributes['sezione'],
            1 => $this->attributes['titolo'],
            3 => $this->attributes['num_post'],
            4 => $this->attributes['data'] = $this->conn->get_timestamp(),
        );
        if(!$this->conn->statement_insert($this->table_descr['table'],$name, $value, $type) ){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $id = $this->conn->last_id;
        $this->attributes[$this->table_descr['key']] = $id;
        $this->add_post($text, $user);
        if($this->err_descr == ''){
            return true;
        }else{ return false; }
    }
    
    public function add_post($text, $user){
        if(!is_array($user) || !is_string($text)){
            $this->err_descr = 'ERROR:Bad parameters';
            return false;
        }
        $p = new post();
        $fk = $this->attributes[$this->table_descr['key']];
        if($p->new_post($text,$user,$fk)){           
            $this->attributes['num_post']++;
            $this->err_descr = '';
            return true;            
        }else{
            $this->err_descr = $p->err_descr;
            return false;
        }
    }
    
    public function get_posts(){
        if($this->attributes[$this->table_descr['key']]==-1){
            $this->err_descr = "ERROR: object is not initialized";
            return false;
        }
        $t = new post();        
        $params = array(
            'fk_conversazione' => $this->attributes[$this->table_descr['key']],            
        );        
        $posts = $t->search_posts($params);
        if($t->err_descr != ''){
            $this->err_descr = $t->err_descr;
            return false;
        }
        $this->err_descr = '';
        return $posts;
    }

    public function search_conversazioni($params, $after=-1, $limit=-1){
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
        $query .= " ORDER BY 'data'";
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
                $app[$j]=$res->fetch_array(MYSQLI_BOTH);                
            }            
            return $app;
        }        
    }
    
}

class post extends gen_model
{    
    function __construct( $id = -1){
        parent::__construct();
        
        $this->attributes = array(
            'id_post'=>-1,
            'fk_conversazione' => -1,            
            'user' => 'user',
            'image' => 'user',
            'punteggio' => 'user',
            'text' => 'Hello World!',
            'time'=>'',
        );        
        $this->table_descr = array(
            'table' => 'post',
            'key'=>'id_post',
            'key_type'=>'i',
            'column_name' => 'fk_conversazione,user,image,punteggio,text,time',
            'column_type' => 'i,s,s,,i,s,t',
        );        

        if($id != -1){
            $params = array(
                $this->table_descr['key'] => $id,
            );
            $post = $this->search_posts($params);
            $this->init($post[0]);           
        }
    }
    
    public function init ($params){
        if(!is_array($params) && count($params)>0 ){
            $this->err_descr = 'ERROR: object not initialaized';
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
    
    public function get_post(){
        if($this->attributes['fk_conversazione'] == -1 || count($this->attributes['text'])==0){
            $this->err_descr='ERROR:post is not initialized';
            return false;
        }
        return $this->attributes;
    }

    public function new_post($text, $user, $fk_conv=-1){
        if($fk_conv == -1){
            if($this->attributes['fk_conversazione']==-1){
                $this->err_descr = "ERROR: No conversation is setted";
                return false;
            }          
        }else{
            $this->attributes['fk_conversazione'] = $fk_conv;
        }
        if(count($text)==0 || !is_array($user) || count($user)==3){
            $this->err_descr = "ERROR: bad parameters";
            return false;
        }
        $this->attributes['user'] = $user['user'];
        $this->attributes['text'] = $user['image'];
        $this->attributes['text'] = $user['punteggio'];        
        $this->attributes['text'] = $text;
        if($this->attributes['time'] == ''){
            $this->attrubutes['time'] = $this->conn->get_timestamp();
        }
        $name = $this->table_descr['column_name'];
        $type = $this->table_descr['column_type'];
        $value = array(
            [0]=>$this->attributes['fk_conversazione'],            
            [1]=>$this->attributes['user'],
            [2]=>$this->attributes['image'],
            [3]=>$this->attributes['punteggio'],
            [4]=>$this->attributes['text'],
            [5] => $this->attrubutes['time'],
        );        
        if(!$this->conn->statement_insert($this->table_descr['table'], $name, $value, $type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        conversazione::$inserted = true;
        $this->err_descr = '';
        return true;       
    }
    
    public function search_posts($params, $after=-1, $limit=-1){
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
        $query .= " ORDER BY 'time'";
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
                $app[$j]=$res->fetch_array(MYSQLI_BOTH);                
            }            
            $this->err_descr = '';
            return $app;
        }
     }
    
}
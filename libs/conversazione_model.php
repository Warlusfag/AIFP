<?php

const limit_post = 10;

class conversazione extends gen_model
{
    function __construct($id=-1, $titolo=-1){
        parent::__construct();        
      
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
            'column_type' => 'i,s,i,t',
        );    

        
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
        $this->attributes['data'] = $this->conn->get_timestamp();
        $this->insert($this->attributes);
        
        $this->attributes[$this->table_descr['key']] = $this->conn->last_id;
        
        $this->add_post($text, $user, $this->attributes['data']);
        if($this->err_descr == ''){
            return true;
        }else{ return false; }
    }
    
    public function add_post($text, $user, $time = -1){
        if(!is_object($user) || !is_string($text)){
            $this->err_descr = 'ERROR:Bad parameters';
            return false;
        }        
        $fk = $this->attributes[$this->table_descr['key']];
        if($time == -1){
            $time = $this->conn->get_timestamp();
            $params = array('num_post'=>$this->attributes['num_post']++);
            $this->update($params);
            if($this->err_descr != ''){
                return false;
            }
        }else{
            $time = $this->attributes['data'];
        }
        $user->write_post($text, $fk, $time );           
        if($user->err_descr == ''){
           return true;                      
        }else{
            $this->err_descr = $user->err_descr;
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
                    if($c_type[$i] == 's' || $c_type[$i] == 'da' || $c_type[$i] == 't'){
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
        $query .= " ORDER BY data DESC";
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
            'tipo_user' => 'user',            
            'text' => 'Hello World!',
            'time'=>'',
        );        
        $this->table_descr = array(
            'table' => 'post',
            'key'=>'id_post',
            'key_type'=>'i',
            'column_name' => 'fk_conversazione,user,tipo_user,text,time',
            'column_type' => 'i,i,s,s,t',
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
        return $this->get_attributes();
    }

    public function new_post($text, $user, $time, $fk_conv=-1){
        if($fk_conv == -1){
            if($this->attributes['fk_conversazione']==-1){
                $this->err_descr = "ERROR: No conversation is setted";
                return false;
            }          
        }else{
            $this->attributes['fk_conversazione'] = $fk_conv;
        }
        if(count($text)==0 || !is_array($user)){
            $this->err_descr = "ERROR: bad parameters";
            return false;
        }
        $this->attributes['user'] = $user['id'];
        $this->attributes['tipo_user'] = $user['tipo'];
        $this->attributes['text'] = $text;
        $this->attributes['time'] = $time;
        
        $this->insert($this->attributes);
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
                    if($c_type[$i] == 's' || $c_type[$i] == 'da' || $c_type[$i] == 't'){
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
        $query .= " ORDER BY time ASC";
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
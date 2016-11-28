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
            'column_name' => 'id_conv,sezione,titolo,num_post,data',
            'colimn_type' => 'i,i,s,i,i,t',
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
    
    public function new_conv($fk_sez, $user, $titolo, $text){
        if(!$this->conn->status){
            $this->conn = new db_interface();
            if(!$this->conn->status){
                $this->err_descr = $this->conn->error;
                return false;
            }
        }
        $this->attributes['fk_sez'] = $fk_sez;
        $this->attributes['titolo'] = $titolo;
        
        $name = extract_node($this->table_descr['column_name'], 0);
        $type = extract_node($this->table_descr['column_type'], 0);
        $value = array(
            0 => $this->attributes['fk_sez'],
            1 => $this->attributes['titolo'],
            3 => $this->attributes['num_post'],
            4 => $this->attributes['data'] = $this->conn->get_timestamp(),
        );
        if(!$this->conn->statement_insert($this->table_descr['table_name'],$name, $value, $type) ){
            $this->err_descr =$this->conn->error;
            return false;
        }
        $p = new post();
        $p->attributes['time'] = $this->attributes['data'];
        $p->new_post($text,$user,$this->conn->last_id);
        $this->posts[0][0]=$p;
        
        $this->err_descr = '';
        return true;
    }
    
    public function load_posts($page){
        if($this->attributes[$this->table_descr['key']]==-1){
            $this->err_descr = "ERROR: object is not initialized";
            return false;
        }
        if($page > limit_post){ return false;}
        //Codice per assicurare un corretto caricamento della pagina
        if(isset($this->posts[0])){
            if(count($this->posts) >= $page){
                $this->posts[$page] = array();
            }else if(count($this->convs) < $page && self::$inserted == false){
                return true;
            }
        }else{ $this->posts[0] = array();}
        //after serve per determinare nella query quali
        $after = 0;
        if($page > 0){ 
            $after = $page*limit_post;
            $page -= 1;            
        }
        $t = new post();        
        $params = array(
            $t->table_descr['fk_conversazione'] => $this->attributes[$this->table_descr['key']],            
        );        
        $posts = $t->search_posts($params, $after, limit_post);
        if($t->err_descr == ''){
            $this->err_descr = $t->err_descr;
            return false;
        }
        if(count($posts)>= limit_conv){
            $n = limit_conv;
        }else{
            $n = count($posts);
        }
        for($i=0;$i<$n;$i++){
            $t = new post();
            $t->init($posts[$i]);            
            $this->$posts[$page][$i] = $t;
        }
        self::$inserted = false;
        $this->err_descr = '';
        return true;
    }
    
    public function show_posts($page){
        if(isset($this->posts[$page])){
            $temp = array();
            $i=0;
            foreach($this->posts as $post){
                $temp[$i] = $post->get_post();
                $user = $post->get_user();
                foreach($user as $key=>$value){
                    $temp[$i][$key] = $value;
                }
            }
            return $temp;
        }
    }

    public function search_conversazioni($params, $after=-1, $limit=-1){
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

class post extends gen_model
{    
    function __construct( $id = -1){
        parent::__construct();
        
        $this->attributes = array(
            'id_post'=>-1,
            'fk_conversazione' => -1,            
            'user' => 'user',
            'text' => 'Hello World!',
            'time'=>'',
        );        
        $this->table_descr = array(
            'table' => 'post',
            'key'=>'id_post',
            'key_type'=>'i',
            'column_name' => 'id_post,fk_conversazione,user,text,time',
            'colimn_type' => 'i,i,s,s,t',
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
            return false;
        }
        foreach($this->attributes as $key=>$value){            
            if(isset($params[$key])){
                $this->attributes[$key]=$params[$key];            
            }
        }
        return true;
    }
    
    public function get_user(){
        if($this->attributes['user'] == 'user'){
            $this->err_descr = 'ERROR: post is not initialized';
            return false;
        }
        $user = array();
        if(!file_exists(IMG_USER.$this->attributes['user'])){
            $user['image']=DEFAULT_IMG;
        }else{
            $user['image'] = IMG_USER.$this->attributes['user'];
        }
        $user['user']=$this->attributes['user'];
        return $user;        
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
        if(count($text)==0){
            $this->err_descr = "ERROR: there is not text";
            return false;
        }
        $this->attributes['user'] = $user;
        $this->attributes['text'] = $text;
        if($this->attributes['time'] == ''){
            $this->attrubutes['time'] = $this->conn->get_timestamp();
        }
        $name = extract_node($this->table_descr['column_name'],0);        
        $type = extract_node($this->table_descr['column_type'],0);
        $value = array(
            [0]=>$this->attributes['fk_conversazione'],
            [1]=>$this->attributes['user'],
            [2]=>$this->attributes['text'],
            [3] => $this->attrubutes['time'],
        );        
        if(!$this->conn->statement_insert($this->table_descr['table'], $name, $value, $type)){
            $this->err_descr = "ERROR: DB is not ready";
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
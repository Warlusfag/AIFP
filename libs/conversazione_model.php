<?php

const limit_post = 5;

class conversazione extends gen_model
{
    public $posts;
    
    function __construct($id=-1, $titolo=-1){
        parent::__construct();
        
        $this->attributes = array(
            'id_conv'=>-1,
            'sezione' => -1,
            'titolo' => 'titolo',
            'user' => 'user',            
            'num_post' => array(),
            'data' => '0-0-0000',
        );        
        $this->table_descr = array(
            'table' => 'conversazioni',
            'key'=>'id_conv',
            'key_type'=>'i',
            'column_name' => 'id_conv,sezione,titolo,user,num_post,data',
            'colimn_type' => 'i,i,s,i,i,da',
        );        
        $this->convs = array();
        for($i=0;$i<limit_page;$i++){
            $this->convs[$i] = array();        
        }
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
    
    public function get_post($page){
        if($page > limit_page){
            $this->err_descr = "ERROR: page over the limit";
            return false;
        }
        if(!isset($this->posts[$page])){
            $this->err_descr = "ERROR: page selected is not right";
            return false;
        }
        $posts = array();
        for($i=0;$i<count($this->posts[$page]);$i++){
            $posts[$i] = $this->posts[$page]->attributes;
        }
        return $posts;
    }   
    
    public function load_posts($page){
        if($this->attributes[$this->table_descr['key']]==-1){
            $this->err_descr = "ERROR: object is not initialized";
            return false;
        }        
        $after = 0;
        if($page > 0){ 
            $after = $page*limit_post;
            $page -= 1;            
        }
        $t = new post();        
        $params = array(
            $t->table_descr['fk_conversazione'] => $this->attributes[$this->table_descr['key']],            
        );        
        $posts = $t->search_posts($params, $after, limit_conv);
        if(!$t){
            $this->err_descr = GEN_ERROR;
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
            $this->$posts[$page][$posts[$i][$t->table_descr['key']]] = $t;
        }
        return true;
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
    public $user;
    
    function __construct( $id = -1){
        parent::__construct();
        
        $this->attributes = array(
            'id_post'=>-1,
            'fk_conversazione' => -1,            
            'user' => 'user',
            'text' => 'Hello World!',
            'ordine' => -1,
            'time'=>'00:00',
        );        
        $this->table_descr = array(
            'table' => 'post',
            'key'=>'id_post',
            'key_type'=>'i',
            'column_name' => 'id_post,fk_conversazione,user,text,ordine,time',
            'colimn_type' => 'i,i,s,s,i,t',
        );
        
        $this->user = array(
            'user' => 'user',
            'punteggio'=>1,
            'image'=>IMG_USER,
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
        $c = $this->table_descr['column_name'];
        $params = array(
            $c[1] => $this->attributes['fk_conversazione'],
        );        
        $posts = $this->search_posts($params);
        $n = count($posts);        
        $n++;
        //codice per l'inserimento del post
        $name = $this->table_descr['column_name'];
        $type = $this->table_descr['column_type'];
        $value = array(
            [0]=>$this->fk_conv,
            [1]=>$this->text,
            [3]=>$n,
        );        
        if(!$this->conn->statement_insert($this->table_descr['table'], $name, $value, $type)){
            $this->err_descr = "ERROR: DB is not ready";
            return false;
        }
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
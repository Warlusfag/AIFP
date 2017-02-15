<?php

    require_once 'admin/db_interface.php';


class gen_model{
    
    public $conn;
    
    public $attributes;
    public $table_descr;
    public $err_descr;
    
    function __construct(){
        $this->conn = new db_interface();
        if(!$this->conn->status){
            return null;
        }
        
        $this->attributes = array();
        $this->table_descr = array();
        $this->err_descr="";
    }   
    
    public function init($params){
        if(!is_array($params)){
            $this->err_descr = "ERROR: failed input";
            return false;
        }
        foreach(array_keys($this->attributes) as $key){
            if(isset($params[$key])){
                $this->attributes[$key]=$params[$key];            
            }
        }
        return true;
    }
    
    public function get_attributes($way = -1){
        if($way == -1){
            return $this->attributes;
        }else if(isset($this->attributes[$way])){
            return $this->attributes[$way];            
        }else{
            return false;
        }
    }
    
    public function insert($params){
        if(!is_array($params)){
            return false;
        }
        $i=0;
        $val= array();
        //Nomi collonne della tabella user e descr
        $name=$this->table_descr['column_name'];
        $type = $this->table_descr['column_type'];
        foreach($this->attributes as $key=>$value){
            if($key != $this->table_descr['key']){
                //se nei parametri quel valore non è settato allora lo prendo nei default, altrimento lo assegno
                if(!isset($params[$key])){
                    $val[$i]=$value;
                }else{
                    $val[$i]=$params[$key];
                }
                $i++;
            }            
        }
        if(!$this->conn->statement_insert($this->table_descr['table'],$name,$val,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr='';
        return true;       
    }
    
    public function update($params=array()){
        if(count($params)==0){
            $params = $this->attributes;
        }
        $value=array();
        $t='';
        $name = '';       
        $keys=explode(',',$this->table_descr['column_name']);
        $type=explode(',',$this->table_descr['column_type']);
        foreach($keys as $i => $key){
            //controllo se è un calore di descr
            if(isset($params[$key])){
                if($key == $this->table_descr['key']){
                    $this->err_descr = "ERROR: failed input";
                    return false;
                }
                $value[]=$params[$key];
                $name .= $key.',';
                $t .= $type[$i].',';
            }                
        }
        $name = substr_replace($name, '', count($name)-2);
        $t = substr_replace($t, '', count($t)-2);
        $id_arr= array(
            0=>$this->table_descr['key'],
            1=>$this->attributes[$this->table_descr['key']],
            2=>$this->table_descr['key_type'],
        );
        if(count($value)>0){
            if(!$this->conn->statement_update($this->table_descr['table'],$name,$value,$t,$id_arr)){            
                $this->err_descr = $this->conn->error;
                return false;
            }
        }else{$this->err_descr = "ERROR:bad input"; return false;}        
        $this->err_descr = '';
        return true;       
    }
    
    public function delete(){
        if($this->attributes[$this->table_descr['key']] == -1){
            $this->err_descr = "ERROR: user is not initialized";
            return false;
        }        
        $name=$this->table_descr['key'];
        $type=$this->table_descr['key_type'];
        $value=array( 0=>$this->attributes[$this->table_descr['key']],);
        if(!$this->conn->statement_delete($this->table_descr['table'], $name, $value, $type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr = '';
        return false;        
    }
    
    public function search($params, $limit=-1, $order = -1)
    {
         if(!is_array($params) || $limit == 0){
             $this->err_descr = 'ERROR:Bad input';
            return false;
        }
        $query = "SELECT * FROM ".$this->table_descr['table']." AS U";
        if(count($params)>0){
            $query .= " WHERE ";
            //estraggo i nomi delle colonne, e verifico se sono presenti, se ci sono aggiungo la query
            $column = explode(',', $this->table_descr['key'].','.$this->table_descr['column_name']);
            $c_type = explode(',', $this->table_descr['key_type'].','.$this->table_descr['column_type']);
            foreach($column as $i=>$key){
                if(isset($params[$key])){
                    if($c_type[$i] == 's' || $c_type[$i] == 'da' || $c_type[$i] == 't'){
                        $query .= "U.$key='$params[$key]' AND ";                        
                    }else{
                        $query .= "U.$key=$params[$key] AND ";
                    }
                }
            }
            //elimino lo spazio
            $query = substr_replace($query, '', count($query)-6);
        }
        if($order != -1){
            $query .= " ORDER BY \'$order\' ";
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
   
}

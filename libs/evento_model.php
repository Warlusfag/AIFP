<?php

require_once 'gen_model.php';
require_once 'admin/setup.php';

class evento extends gen_model
{     
    function __construct()
    {        
        parent::__construct(); 
        
        $this->attributes = array(
            'id_evento'=>-1,
            'titolo' => '',
            'id_ass' => -1,
            'tipologia' => '',
            'regione' => '',
            'provincia'=> '',
            'data_inizio' => -1,
            'data_fine' => -1,
        );
        
        $this->table_descr = array(
            'table' => 'eventi',
            'key'=>'id_evento',
            'key_type'=>'i',
            'column_name' => 'id_eventi,id_ass,titolo,tipologia,regione,provincia,data_inizio,data_fine',
            'colimn_type' => 'i,i,s,s,s,s,da,da',
        );
    }
    
    public function show_news ($limit){
        
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                return false;
            }
        }        
        $date = $this->conn->get_curdate();
        
        $params = array();
        $after = array(
            'data_inizio' => $date,
        );
       $news = $this->search_eventi($params,$after, $limit);
       if($this->err_descr != ''){
           return false;
       }   
       return $news;               
    }
    
    public function add_evento ($params, $ass)
    {
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                $this->err_descr = $this->conn->error;
                return false;
            }
        }

        $table=$this->table_descr['table'];
        $name = extract_node($this->table_descr['column_name'], 0);        
        $type = extract_node($this->table_descr['column_type'], 0);
        
        $keys = explode(',',$this->table_descr['column_name']);
        $values = array();
        $i=0;
        foreach($keys as $key){
            if(isset($params[$key]) && $key != $this->table_descr['key']){
                if($key == 'id_ass'){
                    $values[$i] = $ass->attributes['key'];
                }
                $values[$i]=$params[$key];
                $i++;
            }            
        }
        if(!$this->conn->statement_insert($table, $name, $values, $type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        
        //send email to confirm
        $this->err_descr = '';
        return true;
        
    }
    
    //Ancora da finire
    public function register_evento( $email)
    {     
            
        $titolo = $ev['titolo'];
        $subject="AIFP: un utente si è inscritto al tuo evento: $titolo ";
        $text= "Gentile associazione ".$ass['nome'].","
                . "con la presente email le vogliamo comunicare che un utente si appena inscritto "
                . "al suo evento ";

        $subject="AIFP: email di conferma dell\'avenuta inscrizione all\'evento: $titolo ";
        $text= "Gentile utente,"
                . "con la presente email le confermiamo l'avvenuta registrazione ";
            
        
    }
    
    public function search_eventi($params, $after = -1, $limit=-1){
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                $this->err_descr = "ERROR: DB is not ready";
                return false;
            }
        }
        $query = "SELECT * FROM $this->table_descr['table']";
        if(count($params) > 0 || is_array($after)){
             $query .= " WHERE ";
            $column = explode(',', $this->table_descr['column_name']);
            foreach( $column as $key){
                if(isset($params[$key])){
                    $query .= $key."=".$params[$key]." AND ";
                }
            }
            if(is_array($after)){
                foreach($after as $key=>$value){
                    $query .= "$key >= $after AND ";
                }
            }            
            $query = str_replace($query, '', count($query)-6);
        }
        if($limit > 0){
            $query .= " LIMIT $limit";            
        }
        $query .= " ORDER BY $this->attributes['data_inzio];";
        
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
        
    
}
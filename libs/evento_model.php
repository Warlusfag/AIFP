<?php

require_once 'gen_model.php';
require_once 'admin/setup.php';

class evento extends gen_model
{     
    
    static public $inserted;
    
    function __construct()
    {        
        parent::__construct(); 
        
        self::$inserted = true;
        
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
            'column_name' => 'id_ass,titolo,tipologia,regione,provincia,data_inizio,data_fine',
            'colimn_type' => 'i,s,s,s,s,da,da',
        );
    }
    
    public function show_news ($limit){
        
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                return false;
            }
        }
        //If tinserted is false i have already update all my news
        if(!self::$inserted){
            return true;
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
       self::$inserted = false;
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
        $name = $this->table_descr['column_name'];
        $type = $this->table_descr['column_type'];
        
        $keys = explode(',',$this->table_descr['column_name']);
        $values = array();
        $i=0;
        foreach($keys as $key){
            if(isset($params[$key]) && $key != $this->table_descr['key']){
                if($key == 'id_ass'){
                    $values[$i] = $ass->attributes[$this->table_descr['key']];
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
        self::$inserted = true;
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
        $query = "SELECT * FROM ". $this->table_descr['table']." AS U";
        if(count($params) > 0){
            $query .= " WHERE ";
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
            if(is_array($after)){
                foreach($after as $key=>$value){
                    $query .= "$key >= $after AND ";
                }
            }            
            $query = str_replace($query, '', count($query)-6);
        }
        $query .= " ORDER BY ".$this->attributes['data_inzio'];
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
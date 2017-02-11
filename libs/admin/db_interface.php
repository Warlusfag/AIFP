<?php

class db_interface
{   
    static private $connection;
    protected $queries;
    
    public $error;
    public $last_query;
    public $last_id;
    public $status;   
    
    static private  $db_params =  array(
        'database'=>"DB_AIFP",
        'user'=>"admin_aifp",
        'password'=>"AIFP_user",
        'server'=>"localhost",
        'port'=>3306,
    );   
    
    function __construct(){       
        if(!self::$connection){           
            self::$connection = new mysqli(self::$db_params['server'], self::$db_params['user'], self::$db_params['password'], self::$db_params['database']);
            
        }
        if (self::$connection->connect_error){
            $this->status = false;
            $this->error = self::$connection->connect_error;
        }
        else{
            $this->status=true;
        }
        $this->last_query = "";
        $this->last_id=-1;
    }
    
    /*mode può essere sia:
     * sql
     * html
     * shell
     * che l'uninonde delle stringhe esempio sqlhtml
     */
    public function sanitaze_input($input, $mode){
        
        if (strpos($mode, 'html') !== false){
            $input = htmlentities($input);
        }
        if (strpos($mode, 'sql') !== false){
            $input = self::$connection->real_escape_string($input);
        }
        if (strpos($mode, 'shell') !== false){
            $input = escapeshellcmd($input);
        }
        return $input;
        
    }
    
    public function format_date($date){
        //Codice per rendere una data con gli / per SQL
        
    }
    
    public function get_timestamp(){
        return date('Y-m-d H:i:s',time());
    }
    public function get_current_date(){
        return date('Y-m-d',time());
    }

    //Metodi per l'utilizzo di questa classe come 
    function close()
    {
        self::$connection->close();
    }
    
    function query ($query)
    {
        $f_insert = false;
        if(strstr($query, 'INSERT')||strstr($query, 'DELETE')){
            $f_insert = true;
        }
        $res = self::$connection->query($query);        
        if(!$res)
        {
            $this->status = false;
            $this->error = self::$connection->error;
            return null;
        }
        else{
            if($f_insert == true){
                $this->last_id = self::$connection->insert_id;
            }
            $this->status=true;
            return $res;
        }
    }

    private function execute_stmt($query, $g_param){
        if(!$g_param){
            return false;
        }else{
            $stmt = self::$connection->prepare($query);    
            if($stmt == false){
                $this->status = false;
                $this->error = self::$connection->error;
                return false;
            }else{
             $this->status=true;}

            call_user_func_array( array($stmt, 'bind_param'), $g_param);
            
            if(!$stmt->execute()){
                $this->status = false;
                $this->error = self::$connection->error;
                return false;
            }
            $this->status=true;            
            if(self::$connection->insert_id > 0){
                $this->last_id = self::$connection->insert_id;
            }
            else{
                $this->last_id = -1;
            }
            return true;
        }
    }
    
    public function statement_update($table, $param_name, $param_value, $param_type, $id_arr ){
        if(count($param_name)!=count($param_type)){
            $this->status=false;
            $this->error='Error, in the number of parameters';
            return false;
        }
        $query="UPDATE $table ";        
        $set="SET ";
        $ptype='';
        $g_param= array();

        $param_name = explode(',', $param_name);
        for( $i=0; $i<count($param_name);$i++){               
            if($param_type[$i] == 'da'){
                $set.=$param_name[$i]." = str_to_date(?,\'%Y-%m-%d\'), ";
                $ptype .= 's';
            }
            else if($param_type[$i] == 't'){
                $set .=$param_name[$i]." = str_to_date(?,\'%Y-%m-%d %H:%i:%s\'), ";
                $ptype .= 's';                    
            }
            else{
                $set .= $param_name[$i]." = ?, ";
                $ptype .= $param_type[$i];
            }
        }
        //codice per inserire uno spazio al posto della virgola finale
        $set = substr_replace($set, ' ', count($set)-3);
        
        $where = ' WHERE '.$id_arr[0].'='.$id_arr[1].';';
        $q = $query.$set.$where;                

        $g_param[] = & $ptype;
        for($i=0;$i<count($param_value);$i++){
            $g_param[] = & $param_value[$i];
        }
        $this->execute_stmt($q, $g_param);
        return $this->status;        
    }
    
    function statement_insert ($table, $param_name, $param_value, $param_type)
    {
        if(count($param_name)!=count($param_type)){
            $this->status=false;
            $this->error='Error, in the number of parameters';
            return false;
        }
        $g_param = array();

        $query="INSERT INTO $table ";
        $query_val = "VALUES ( ";
        $query_name = "( ";           
        //nomi delle colonne della tabella dove sto inserendo
        $param_name = explode(',', $param_name);
        for($i=0; $i < count($param_name);$i++){           
            $query_name .= $param_name[$i].', ';            
        }
        //Ci metto il meno 3 perché uno per il valore count, uno per lo spazio e uno per la virgola
        $query .= substr_replace($query_name, ') ', count($query_name)-3);        
        
        //ora faccio la parte dei parametri
        $param_type = explode(',', $param_type);
        $ptype='';
        for($i=0; $i<count($param_type);$i++){
            if($param_type[$i] == 'da'){
                $query_val.='str_to_date(?,\'%Y-%m-%d\'), ';
                $ptype .= 's';
            }
            else if($param_type[$i] == 't'){
                $query_val.='str_to_date(?,\'%Y-%m-%d %H:%i:%s\'), ';
                $ptype .= 's';                    
            }
            else{
                $query_val.='?, ';
                $ptype .= $param_type[$i];
            }
        }
        //levo la virgola alla fine, metto la parentesi e il punto virgola di fine query;
        $query_val = substr_replace($query_val, ');', count($query_val)-3);
        $query .= $query_val; 

        //serve per la funzione dopo che fa il bind dei parametri in automatico
        $g_param[] = & $ptype;
        for($i=0;$i<count($param_value);$i++)
        {
            $g_param[] = & $param_value[$i];
        }                      
        
        $this->execute_stmt($query, $g_param);
        return $this->status;
    }
    
    function statement_delete($table, $param_name, $param_value, $param_type){
        if(count($param_name)!=count($param_type)){
            $this->status=false;
            $this->error='Error, in the number of parameters';
            return false;
        }
        $query_init = "DELETE FROM $table ";
        $ptype = '';
        $cond="WHERE ";
        $g_param = array();

        $param_name = explode(',', $param_name);
        for( $i=0; $i<count($param_name);$i++){               
            if($param_type[$i] == 'da'){
                $cond.= $param_name[$i]."= str_to_date(?,\'%Y-%m-%d\') AND ";
                $ptype .= 's';
            }
            else if($param_type[$i] == 't'){
                $query_val.='str_to_date(?,\'%Y-%m-%d %H:$i:%s\'), ';
                $ptype .= 's';                    
            }
            else{
                $cond .= $param_name[$i]."=? AND ";
                $ptype .= $param_type[$i];
            }
        }
        //codice per eliminare la virgola finale ed inserire  lo spazio
        $cond = substr_replace($cond, ';', count($cond)-6);
        $query = $query_init.$cond;
                
        $g_param[] = & $ptype;
        for($i=0;$i<count($param_value);$i++)
        {
            $g_param[] = & $param_value[$i];
        }

        $this->execute_stmt($query, $g_param);
        return $this->status;
    }
}


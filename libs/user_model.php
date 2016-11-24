<?php
require_once 'gen_model.php';
require_once 'admin/setup.php';

//ancora da finire
const limit_filesize = 440000;

function get_us_from_type($type){
    if($type == 'utente'){
        $us = new user();
    }
    else if($type == 'inscritto'){
        $us = new inscritto();
    }
    else if($type == 'micolgo'){
        $us = new inscritto();
    }
    else if($type == 'botanico'){
        $us = new inscritto();
    }
    else{return null;}
    
    return $us;    
}

function search_OnAll_users($params){
    $us = new user();
        $temp = $us->search_user($params);        
        if(!$temp){
            $us = new inscritto();
            $temp = $us->search_user($params);
            if(!$temp){
                $us = new micologo();
                $temp = $us->search_user($params);
                if(!$temp){
                    $us = new botanico();
                    $temp = $us->search_user($params);
                    if(!$temp){
                        $us = new asociazione();
                        $temp = $us->search_user($params);
                        if(!$temp || count($temp)== 0 ){
                            return null;                            
                        }
                    }

                }
            }
        }
        if (count($temp)==1){
            $id = array( $us->table_descr['key'] => $temp[0][$us->table_descr['key']]);
            $temp_descr = $us->search_descr_user($id);
            $us->init($temp, $temp_descr);
            return $us;
        }else{
            return $temp;
        }

}

function search_OnAll_descr_users($params){
    $us = new user();
        $temp_descr = $us->search_descr_user($params);        
        if(!$temp_descr){
            $us = new inscritto();
            $temp_descr= $us->search_descr_user($params);
            if(!$temp_descr){
                $us = new micologo();
                $temp_descr = $us->search_descr_user($params);
                if(!$temp_descr){
                    $us = new botanico();
                    $temp_descr = $us->search_descr_user($params);
                    if(!$temp_descr){
                        $us = new asociazione();
                        $temp_descr = $us->search_descr_user($params);
                        if(!$temp_descr || count($temp_descr)== 0 ){
                            return null;                            
                        }
                    }

                }
            }
        }
        if (count($temp_descr)==1){
            $id = array( $us->table_descr['key'] => $temp[0][$us->table_descr['key']]);
            $temp = $us->search_user($id);
            $us->init($temp, $temp_descr);
            return $us;
        }else{
            return $temp_descr;
        }

}


//normal user
class user extends gen_model{       
    public $attributes_descr;
    
    function __construct(){       
        
        parent::__construct();
        
        $this->table_descr=array(
            'table' =>'utenti',
            'type' =>'utente',
            'key' =>'id_user',
            'key_type'=>'i',
            'table_descr'=>'descr_user',
            'column_name'=>'email,user,password,nome,cognome,residenza,data',
            'column_descr'=>'user,num_post,punteggio,patentino',
            'column_type'=>'s,s,s,s,s,s,da',
            'column_type_descr'=>'i,i,i',
        );
        
        $this->attributes = array(
            'id_user' => -1,
            'email' => "",
            'password'=>"",
            'user' => 'user',
            'nome' => '',
            'cognome' => '',
            'residenza' => "",
            'data'=>"",
        );
        
        $this->attributes_descr = array(
            'id_user' => -1,
            'num_post' => 0,
            'punteggio' => 0,
            'image' => DEFAULT_IMAGE,
            'patentino' => 0,
        );

    }
    
    public function check_pwd($password)
    {
        if($this->table_descr['password'] == md5($password)){
            return true;
        }
        return false;
    }
    
    public function change_pwd($password){
        $this->table_descr['password'] = md5($password);
        //Codice per l'update
    }
    
    
    public function insert_user($params, $params_descr){
        if(!is_array($params)|| !is_array($params_descr)){
            return false;
        }
        $i=0;
        $val= array();
        $name=$this->table_descr['column_name'];
        $type = $this->table_descr['column_type'];
        foreach($this->attributes as $key=>$value){
            if($key != $this->table_descr['key']){                
                if(!isset($params[$key])){
                    $val[$i]=$value;
                }else{
                    $val[$i]=$params[$key];
                }
            }
            $i++;
        }
        if(!$this->conn->statement_insert($this->table_descr['table'],$name,$value,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        //inserimento nella tabella descritpion
        $this->attributes_descr[$this->table_descr['key']]=$this->conn->last_id;        
        $i=0;
        $val= array();
        $name=$this->table_descr['key'].','.$this->table_descr['column_descr'];
        $type = $this->table_descr['column_type_descr'];
        foreach($this->attributes_descr as $key=>$value){
            if(!isset($params_descr[$key])){
                $val[$i]=$value;
            }else{
                if($key != $this->table_descr['key']){
                    $val[$i]=$params_descr[$key];
                }else{
                    $val[$i]=$value;
                }
            }
            $i++;
        }
        if(!$this->conn->statement_insert($this->table_descr['table_descr'],$name,$value,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr='';
        return true;       
    }
    
    
    public function delete_user(){
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
    
    
    public function search_user($params)
    {
        if(!is_array($params) || !$this->conn->status ){
            return false;
        }
        $query = "SELECT * FROM $this->table_descr['table_descr'] AS U";
        if(count($params)>0){
            $query .= " WHERE ";
            $column = explode(',',$this->table_descr['column_name']);
            foreach($column as $key){
                if(isset($params[$key])){
                    $query .= "U.$key=$params[$key] AND ";                 
                }
            }        
            $query = substr_replace($query, '', count($query)-6);
        }
        $query .= ";";
        
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
    
    public function search_descr_user($params)
    {          
        if(!is_array($params) || !$this->conn->status ){
            return false;
        }
        $query = "SELECT * FROM $this->table_descr['table_descr'] AS U";
        if(count($params)>0){
            $query .= " WHERE ";        

            foreach($params as $key=>$value){              
                $query .= "U.$key=$value AND "; 
            }        
            $query = substr_replace($query, '', count($query)-6);
        }
        $query .= ";";
        
        $res = $this->conn->query($query);
        if (!$this->conn->status){                            
            $this->err_descr="ERROR: failed execution query \n ".$this->conn->error;
            return false;
        }
        if (($nr = $res->num_rows) >= 1){
            $app=array();
            $nr = $res->num_rows;
            for ($j=0; $j<$nr; $j++){
                $res->data_seek($j);
                $app[$j]=$res->fetch_assoc();
            }                
            return $app;
        }else{
            $this->err_descr="ERROR: No results found \n ";
            return false;
        }       
   }
   
    public function init($us, $us_descr){
        if(!is_array($us) || !is_array($us_descr)){
            return false;
        }
        foreach($this->attributes as $key=>$value){
            if(isset($us[$key])){
                $this->attributes[$key]=$us[$key];            
            }
        }
        foreach($this->attributes_descr as $key=>$value){
            if(isset($us_descr[$key])){
                $this->attributes_descr[$key]=$us_descr[$key];            
            }
        }
        return true;
    }   

    
    //metodo per aggiornare tutte le modifiche fatte nel DB
    public function update_user(){
        if ($this->attributes[$this->table_descr['key']] == -1){
            $this->err_descr = 'ERROR: User is not initialized';
            return false;
        }
        $value=array();$i=0;
        foreach($this->attributes as $value){
            $value[$i]=$value;
            $i++;
        }
        $name=$this->table_descr['column_name'];
        $type=$this->table_descr['column_type'];       
        $id_arr= array(
            0=>$this->table_descr['key_name'],
            1=>$this->id,
            2=>'i',
        );
        $this->conn = statement_update($this->table_descr['table_name'],$name,$value,$type,$id_arr);
        if(!$this->conn->status){
            $this->err_descr = $this->conn->error;
            return false;
        }        
        $name=$this->table_descr['column_descr_name'];
        $type=$this->table_descr['column_descr_type'];
        $i=0;
        foreach($this->attributes_descr as $value){
            $value[$i]=$value;
            $i++;
        }        
        $id_arr= array(
            0=>$this->table_descr['key_name'],
            1=>$this->attributes[$this->table_descr['key']],
            2=>'i',
        );
        $this->conn = statement_update($this->table_descr['table_descr'],$name,$value,$type,$id_arr);
        if(!$this->conn->status){
            $this->err_descr = $this->conn->error;
            return false;
        }        
        $this->err_descr = '';
        return true;       
    }
    
    
    public function write_post($fk_conv, $text)            
    {
        require_once 'post_class.php';
        
        if($this->attributes[$this->table_descr['key']] == -1){
            $this->err_descr = "Error: you have to initialize user class";
            return false;
        }        
        if($fk_conv == -1 || !isset($fk_conv) ){
            $this->err_descr = "Error: conversaton id is not set";
            return false;                
        }
        $user = array(
            'user'=>$this->attributes['user'],
            'punteggio'=>$this->attributes['punteggio'],
            'image'=>$this->attributes_descr['image'],
        );
        $p = new post();
        $p->new_post( $user, $text, $fk_conv);
        if($p->err_descr != ''){
            $this->err_descr = $p->err_descr;
            return false;
        }
        $this->attributes['punteggio']+=1;
        $this->err_descr = '';
        return true;              
    }
    
    public function register_evento($id_evento)
    {
        require_once 'evento_class.php';
        
        if($this->attributes[$this->table_descr['key']] == -1){        
            $this->err_descr='Error: user have to be initializate';
            return false;           
        }
        $ev = new evento();
        if ( !$ev->register_evento($id_evento, $this->email) ){
            $this->err_descr='Error: while adding an event';
            return false;     
        }
        $this->err_descr='';
        return true;             
    }
    
    public function load_image($file_image)
    {
        if($this->attributes[$this->table_descr['key']] == -1){
            $this->err_descr = "Error, you have to initialize user, which user wants change the image?";
            return false;
        }
        if (file_exists()){
            $this->err_descr = "Error, the file already exists";
            return false;            
        }
        $path = IMG_USER.$this->attributes['user'];
        $size = $file_image['userfile']['size'];
        if((file_exists($path))){
          if (!unlink($path)){
              $this->err_descr='Error, impossible delete a previous image file';
              return false;
          }
        }
        //creazione del file
        $upfile = $path.['userfile']['name'];
        if (!move_uploaded_file($file_image['userfile']['temp_name'], $upfile)){
            $this->err_descr = 'ERROR: an erro occurred while uplloading file';            
            return false;            
        }
        
    }
    
}
//subscribe user
class inscritto extends user
{   
    function __construct()
    {        
        parent::__construct();        
        $this->table_descr['table'] = 'inscritti';
        $this->table_descr['table_descr'] = 'descr_inscr';
        $this->table_descr['key'] = 'id_inscr';
        $this->table_descr['type'] = 'inscritto';
        $this->table_descr['column_name']='associzione,email,user,password,nome,cognome,residenza,data';
        $this->table_descr['column_descr']='num_post,punteggio,patentino,esperto';
        $this->table_descr['column_type']='i,s,s,s,s,s,s,da';
        $this->table_descr['column_type_descr'] = 'i,i,i,i';                
        $this->attributes_descr['esperto'] = false;
        $this->attributes_descr['id_inscr'] = -1;
        $this->attributes['associazione'] = -1;
        $this->attributes['id_inscr'] = -1;
    }
}

class micologo extends inscritto
{    
    function __construct(){
        parent::__construct();        
        $this->attributes_descr['esperto'] = true;
        $this->table_descr['table_name'] = 'micologi';
        $this->table_descr['table_descr'] = 'descr_mico';
        $this->table_descr['key_name'] = 'id_mico';
        $this->table_descr['type'] = 'micologo';
        $this->attributes['id_mico'] = -1;
        $this->attributes_descr['id_mico'] = -1;
    }   

}

class botanico extends inscritto
{   
    function __construct(){
        parent::__construct();
        
        $this->attributes_descr['esperto'] = true;
        $this->table_descr['table_name'] = 'botanici';
        $this->table_descr['table_descr'] = 'descr_bot';
        $this->table_descr['key_name'] = 'id_bot';
        $this->table_descr['type'] = 'botanico';
        $this->attributes['id_bot'] = -1;
        $this->attributes_descr['id_bot'] = -1;
    }
}


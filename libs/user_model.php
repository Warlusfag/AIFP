<?php

require_once 'gen_model.php';
require_once 'admin/setup.php';

//ancora da finire
const limit_filesize = 4000000;

//normal user
class user extends gen_model{       
    public $attributes_descr;
    public $type;
    public $default_col;
    
    function __construct(){       
        
        parent::__construct();
        $this->type ='utente';
        
        $this->table_descr=array(
            'table' =>'utenti',            
            'key' =>'id_user',
            'key_type'=>'i',
            'table_descr'=>'descr_user',
            'column_name'=>'email,user,password,nome,cognome,residenza,data',
            'column_descr'=>'num_post,punteggio,image,patentino',
            'column_type'=>'s,s,s,s,s,s,da',
            'column_type_descr'=>'i,i,s,i',
        );
        $this->default_col = array(
            'user' => 'user',
            'num_post' => 0,
            'punteggio' => 0,
            'image' => DEFAULT_IMG,
            'patentino' => 0,            
        );  
        
        $this->attributes = array(
            'id_user' => -1,
            'email' => "",
            'password'=>"",
            'user' => $this->default_col['user'],
            'nome' => '',
            'cognome' => '',
            'residenza' => "",
            'data'=>"",
        );
        
        $this->attributes_descr = array(
            'id_user' => -1,
            'num_post' => $this->default_col['num_post'],
            'punteggio' => $this->default_col['punteggio'],
            'image' => $this->default_col['image'],
            'patentino' => $this->default_col['patentino'],
        );
    }
    
    public function upgrade_esperto(){
        $this->err_descr = 'ERROR: user can not be espert if not subscribe into association';
        return false;
    }
    
    public function make_token(){
        if($this->attributes[$this->table_descr['key']] == -1){
            $this->err_descr = 'ERROR: user is not initialized';
            return false;                    
        }
        return md5($this->attributes['email'].$this->attributes['password']); 
    }

    public function check_pwd($password)
    {
        if($this->attributes[$this->table_descr['key']] == -1){
            $this->err_descr = "ERROR: user is not initialized";
            return false;
        }
        if($this->attributes['password'] == md5($password)){
            return true;
        }
        $this->err_descr = "ERROR: password is not correct";
        return false;
    }
    
    public function get_image(){
        $path = $this->attributes_descr['image'];        
        $path = str_replace('/srv/www', '',$path);
        return $path;
    }
    
    public function change_pwd($password){
        $params = array('password' => md5($password));
        $this->update_user($params);
    }
    
    
    public function insert_user($params, $params_descr){
        if(!is_array($params) && !is_array($params_descr)){
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
        //inserimento nella tabella descritpion
        $this->attributes_descr[$this->table_descr['key']]=$this->conn->last_id;        
        $i=0;
        $val= array();
        //Aggiungo nella colonneanche la chiave foreign key all'inserimento fatto precedentemente
        $name=$this->table_descr['key'].','.$this->table_descr['column_descr'];
        $type = $this->table_descr['key_type'].','.$this->table_descr['column_type_descr'];
        foreach($this->attributes_descr as $key=>$value){
            if(!isset($params_descr[$key])){
                $val[$i]=$value;
            }else{
                //controllo in caso se gli viene passata il nome della colonna per la PK
                if($key != $this->table_descr['key']){
                    $val[$i]=$params_descr[$key];
                }else{
                    $val[$i]=$value;
                }
                
            }
            $i++;            
        }
        if(!$this->conn->statement_insert($this->table_descr['table_descr'],$name,$val,$type)){
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
    
    //il parametro limit serve per limitare il numero dei risultati
    public function search_user($params, $limit=-1)
    {
         if(!is_array($params) || !$this->conn->status || $limit == 0){
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
                    if($c_type[$i] == 's'){
                        $query .= "U.$key='$params[$key]' AND ";                        
                    }else{
                        $query .= "U.$key=$params[$key] AND ";
                    }
                }
            }
            //elimino lo spazio
            $query = substr_replace($query, '', count($query)-6);
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
    
    public function search_descr_user($params, $limit=-1)
    {          
        if(!is_array($params) || !$this->conn->status  || $limit == 0 ){
            return false;
        }
        $query = "SELECT * FROM ".$this->table_descr['table_descr']." AS U";
        if(count($params)>0){
            $query .= " WHERE ";
            $column = explode(',', $this->table_descr['key'].','.$this->table_descr['column_descr']);
            $c_type = explode(',', $this->table_descr['key_type'].','.$this->table_descr['column_type_descr']);
            foreach($column as $i=>$key){
                if(isset($params[$key])){
                    if($c_type[$i] == 's'){
                        $query .= "U.$key='$params[$key]' AND ";                        
                    }else{
                        $query .= "U.$key=$params[$key] AND ";
                    }
                }
            }        
            $query = substr_replace($query, '', count($query)-6);           
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
        if (($nr = $res->num_rows) >= 0){
            $app=array();
            $nr = $res->num_rows;
            for ($j=0; $j<$nr; $j++){
                $res->data_seek($j);
                $app[$j]=$res->fetch_array(MYSQLI_BOTH);
            }
            $this->err_descr = '';
            return $app;
        }    
   }
   
    public function init($us, $us_descr){
        if(!is_array($us) || !is_array($us_descr)){
            $this->err_descr = "ERROR: failed input";
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
    
    //metodo per aggiornare in modo dinamico i singoli campi nel DB
    public function update_user($params=array(), $params_descr=array()){
        if(count($params)>0){
            $value=array();
            $t='';
            $name = '';
            $i=0;        
            $keys=explode(',',$this->table_descr['column_name']);
            $type=explode(',',$this->table_descr['column_type']);
            foreach($keys as $key){
                //controllo se è un calore di descr
                if(isset($params[$key])){
                    if($key == $this->table_descr['key']){
                        $this->err_descr = "ERROR: failed input";
                        return false;
                    }
                    $value[$i]=$params[$key];
                    $name.=$key.',';
                    $t .= $type[$i].',';
                    $i++;
                }                
            }
            $name = substr_replace($name, '', count($name)-1);
            $t = substr_replace($t, '', count($t)-1);
            $id_arr= array(
                0=>$this->table_descr['key_name'],
                1=>$this->id,
                2=>$this->table_descr['key_type'],
            );
            if(count($value)>0){
                $this->conn = statement_update($this->table_descr['table_name'],$name,$value,$t,$id_arr);
                if(!$this->conn->status){
                    $this->err_descr = $this->conn->error;
                    return false;
                }
            }else{$this->err_descr = "ERROR:bad input"; return false;}
        }else if(count($params_descr)>0){
        //ora p
            $name=explode(',',$this->table_descr['column_descr_name']);
            $type=explode(',',$this->table_descr['column_descr_type']);
            $i=0;$value=array();
            foreach($name as $key){
                if(isset($params_descr[$key])){
                    if($key == $this->table_descr['key']){
                        $this->err_descr = "ERROR: failed input";
                        return false;
                    }
                    $value[$i]=$params[$key];
                    $name[$i]=$key;
                    $t[$i]=$type[$i];                
                }
                $i++;
            }         
            $id_arr= array(
                0=>$this->table_descr['key_name'],
                1=>$this->attributes[$this->table_descr['key']],
                2=>'i',
            );
            if(count($value)>0){
                $this->conn = statement_update($this->table_descr['table_descr'],$name,$value,$type,$id_arr);
                if(!$this->conn->status){
                    $this->err_descr = $this->conn->error;
                    return false;
                }
            }
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
        if($fk_conv <= -1 || !isset($fk_conv) ){
            $this->err_descr = "Error: conversaton id is not set";
            return false;                
        }
        $user = array(
            'user'=>$this->attributes['user'],
            'punteggio'=>$this->attributes['punteggio'],
            'image'=>$this->attributes_descr['image'],
        );
        $p = new post();
        $p->new_post($text, $user, $fk_conv);
        if($p->err_descr != ''){
            $this->err_descr = $p->err_descr;
            return false;
        }
        $this->attributes['punteggio']+=10;
        $params_descr = array('punteggio'=> $this->attributes['punteggio'],);
        $this->update_user(array(), $params_descr);
        if($this->err_descr != ''){return false;}
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
        if ( !$ev->register_evento($id_evento, $this->attributes['email']) ){
            $this->err_descr='Error: while adding an event';
            return false;     
        }
        $this->attributes['punteggio']+=10;
        $params_descr = array('punteggio'=> $this->attributes['punteggio'],);
        $this->update_user(array(), $params_descr);
        if($this->err_descr != ''){return false;}
        $this->err_descr = '';
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
        //il nome della fotom sarà la sua primary key
        $path = IMG_USER.$this->attributes['user'];        
        if((file_exists($path))){
          if (!unlink($path)){
              $this->err_descr='Error, impossible delete a previous image file';
              return false;
          }
        }
        //creazione del file
        if (!move_uploaded_file($file_image['userfile']['temp_name'], $path)){
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
        $this->type ='inscritto';
        $this->table_descr['table'] = 'inscritti';
        $this->table_descr['table_descr'] = 'descr_inscr';
        $this->table_descr['key'] = 'id_inscr';        
        $this->table_descr['column_name']='associzione,email,user,password,nome,cognome,residenza,data';
        $this->table_descr['column_descr']='num_post,punteggio,patentino,esperto';
        $this->table_descr['column_type']='i,s,s,s,s,s,s,da';
        $this->table_descr['column_type_descr'] = 'i,i,i,i';                
        $this->attributes_descr['esperto'] = false;
        $this->attributes_descr['id_inscr'] = -1;
        $this->attributes['associazione'] = -1;
        $this->attributes['id_inscr'] = -1;
    }
    
    public function upgrade_esperto(){
        if($this->attributes_descr['esperto'] == true){
            return true;
        }
        if($this->attributes['punteggio'] >= 1000 ){
            return true;
        }else{
            return false;
        }
    } 
    
}

class micologo extends inscritto
{    
    function __construct(){        
        parent::__construct();
        $this->type ='micologo';
        $this->attributes_descr['esperto'] = true;
        $this->table_descr['table'] = 'micologi';
        $this->table_descr['table_descr'] = 'descr_mico';
        $this->table_descr['key'] = 'id_mico';
        $this->attributes['id_mico'] = -1;
        $this->attributes_descr['id_mico'] = -1;
    }   

}

class botanico extends inscritto
{   
    function __construct(){
        
        parent::__construct();
        $this->type ='botanico';        
        $this->attributes_descr['esperto'] = true;
        $this->table_descr['table'] = 'botanici';
        $this->table_descr['table_descr'] = 'descr_bot';
        $this->table_descr['key'] = 'id_bot';
        $this->attributes['id_bot'] = -1;
        $this->attributes_descr['id_bot'] = -1;
    }
}


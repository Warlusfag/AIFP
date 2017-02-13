<?php

require_once 'gen_model.php';
require_once 'admin/setup.php';


//ancora da finire
const limit_filesize = 4000000;

//normal user
class user extends gen_model{       
    //public $attributes_descr;
    public $type;
    public $default_col;
    
    function __construct(){       
        
        parent::__construct();
        $this->type ='utente';
        
        $this->table_descr=array(
            'table' =>'utenti',            
            'key' =>'id_user',
            'key_type'=>'i',
            'column_name'=>'email,password,user,nome,cognome,regione,residenza,data,num_post,punteggio,image,patentino',
            'column_type'=>'s,s,s,s,s,s,s,da,i,i,s,i',
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
            'regione' => "",
            'residenza' => "",
            'data'=>"",
            'num_post' => $this->default_col['num_post'],
            'punteggio' => $this->default_col['punteggio'],
            'image' => $this->default_col['image'],
            'patentino' => $this->default_col['patentino'],
        );
        
        /*$this->attributes_descr = array(
            'id_user' => -1,
            'num_post' => $this->default_col['num_post'],
            'punteggio' => $this->default_col['punteggio'],
            'image' => $this->default_col['image'],
            'patentino' => $this->default_col['patentino'],
        );*/
    }
    
    public function upgrade_esperto(){
        $this->err_descr = 'ERROR: user can not be espert if not subscribe into association';
        return false;
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
    
    function get_attributes($way = -1) {
        if(($t = parent::get_attributes($way)) != false){
            return $t;
        }else if(strpos($way,',')){
            $t = array();
            $keys = explode(',',$way);
            foreach($keys as $i=>$key){
                if(isset($this->attributes[$key])){
                    $t[$i] = $this->attributes[$key];
                    $t[$key] = $this->attributes[$key];
                }
            }
            return $t;
        }else if('post'){
            $t = array();
            $t['user'] = $this->attributes['user'];
            $t['punteggio'] = $this->attributes['punteggio'];
            $t['image'] = $this->get_image();
            $t['regione'] = $this->attributes['regione'];
            return $t;
        }
        else{
            parent::get_attributes($way);
        }
    }
    
    public function get_image(){
        $path = $this->attributes['image'];        
        $path = str_replace(PROJ_DIR, '',$path);
        return $path;
    }
    
    public function change_pwd($password){
        $params = array('password' => md5($password));
        return $this->update_user($params);
    }
    
    
    public function insert_user($params){
        return $this->insert($params);   
    }
    
    
    public function delete_user(){
        return $this->delete();                
    }
    
    //il parametro limit serve per limitare il numero dei risultati
    public function search_user($params, $limit=-1){
        return $this->search($params, $limit);       
    }  
    
    //metodo per aggiornare in modo dinamico i singoli campi nel DB
    public function update_user($params=array()){
        return $this->update($params);  
    }    
    
    public function write_post($text, $fk_conv, $time)            
    {     
        require_once 'conversazione_model.php';
        
        $id = $this->attributes[$this->table_descr['key']];
        
        if( $id == -1){
            $this->err_descr = "Error: you have to initialize user class";
            return false;
        }        
        if($fk_conv <= -1 || !isset($fk_conv) ){
            $this->err_descr = "Error: conversaton id is not set";
            return false;                
        }        
        $p = new post();
        $us = array(
            'id' => $id,
            'tipo' => $this->type,
        );
        $p->new_post($text, $us, $time, $fk_conv);
        if($p->err_descr != ''){
            $this->err_descr = $p->err_descr;
            return false;
        }
        $this->attributes['punteggio']+=20;
        $this->attributes['num_post']++;
        $params = array(
            'punteggio'=> $this->attributes['punteggio'],
            'num_post' => $this->attributes['num_post'],
            );
        $this->update_user($params);
        if($this->err_descr != ''){return false;}
        $this->err_descr = '';
        return true;              
    }
    
    public function register_evento($id_evento)
    {   
        require_once 'evento_model.php';
        
        if($this->attributes[$this->table_descr['key']] == -1){        
            $this->err_descr='Error: user have to be initializate';
            return false;           
        }
        $ev = new evento();
        if ( !$ev->register_evento($id_evento, $this->attributes['email']) ){
            $this->err_descr=$ev->err_descr;
            return false;     
        }
        $this->attributes['punteggio']+=10;
        $params = array('punteggio'=> $this->attributes['punteggio']);
        $this->update_user($params);
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
        $path = IMG_USER.$this->type.'/'.$this->attributes['user'];
        if($this->attributes['image'] != DEFAULT_IMG){
            if (file_exists($path)){
               unlink($path);
            )else{
                $this->err_descr = 'ERROR:File doesn\'t exist';
                return false;
            }
        }           
        //creazione del file
        if (!move_uploaded_file($file_image['userfile']['temp_name'], $path)){
            $this->err_descr = 'ERROR: an erro occurred while uplloading file';            
            return false;            
        }
        $this->attributes['image'] = $path;
        $value = array( 'image' => $path);
        if(!$this->update($value)){
            return false;
        }else{
            $this->err_descr = '';
            return true;
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
        $this->table_descr['key'] = 'id_inscr';        
        $this->table_descr['column_name']='associazione,email,user,password,nome,cognome,regione,residenza,data,num_post,punteggio,image,patentino,esperto';
        $this->table_descr['column_type']='i,s,s,s,s,s,s,s,da,i,i,s,i,i';             
        $this->attributes['esperto'] = false;
        $this->attributes['id_inscr'] = -1;
        $this->attributes['associazione'] = -1;
        $this->attributes['id_inscr'] = -1;
    }
    
    public function upgrade_esperto(){
        if($this->attributes['esperto'] == true){
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
        $this->attributes['esperto'] = true;
        $this->table_descr['table'] = 'micologi';
        $this->table_descr['table_descr'] = 'descr_mico';
        $this->table_descr['key'] = 'id_mico';
        $this->attributes['id_mico'] = -1;
        $this->attributes['id_mico'] = -1;
    }   

}

class botanico extends inscritto
{   
    function __construct(){
        
        parent::__construct();
        $this->type ='botanico';        
        $this->attributes['esperto'] = true;
        $this->table_descr['table'] = 'botanici';
        $this->table_descr['table_descr'] = 'descr_bot';
        $this->table_descr['key'] = 'id_bot';
        $this->attributes['id_bot'] = -1;
        $this->attributes['id_bot'] = -1;
    }
}


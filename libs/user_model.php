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
        $path = $this->attributes['image'];        
        $path = str_replace('/srv/www', '',$path);
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
            'image'=>$this->attributes['image'],
        );
        $p = new post();
        $p->new_post($text, $user, $fk_conv);
        if($p->err_descr != ''){
            $this->err_descr = $p->err_descr;
            return false;
        }
        $this->attributes['punteggio']+=10;
        $params = array('punteggio'=> $this->attributes['punteggio'],);
        $this->update_user($params);
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
        $params = array('punteggio'=> $this->attributes['punteggio'],);
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
        $path = IMG_USER.$this->attributes['user'];
        if (file_exists($path)){
            unlink($path);           
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


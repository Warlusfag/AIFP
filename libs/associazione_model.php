<?php

if(!defined('associazione')){
    require_once 'user_model.php';
    require_once 'aifp_controller.php';
    define('associazione',1);    
}


class associazione extends user
{   
    public $table_descr_file;
    public $table_descr_req;
    
    function __construct() 
    {
        parent::__construct();
        $this->type= 'associazione';        
        
        $this->table_descr['table'] = 'associazione';
        $this->table_descr['table_descr'] = 'descr_ass';       
        $this->table_descr['key'] = 'ID_ass';
        $this->table_descr['column_name']='ID_ass,email,password,user,nome,regione,indirizzo,CAP';
        $this->table_descr['column_descr']='ID_ass,sito_web,num_post,punteggio,componenti,esperto';
        $this->table_descr['column_type']='i,s,s,s,s,s,s,s';
        $this->table_descr['column_type_descr'] = 'i,s,i,i,i,i';
                
        $this->attributes = array(
            'ID_ass' => -1,
            'email'=> 'default@aifp.com',
            'user' =>'user',
            'password' => 'password',
            'nome' => 'associazione',
            'regione' => 'regione',
            'indirizzo' => 'indirizzo',
            'CAP' => '00000',        
        );
        $this->attributes_descr = array(
            'ID_ass' => -1,
            'sito_web'=> 'default.aifp.com',
            'num_post' => 0,
            'punteggio' => 1,
            'componenti' => 2,
            'esperto' => 1,            
        );
        
        $this->table_descr_file = array(
            'table' => 'file_ass',
            'key' => 'fk_ass',
            'column_name' => 'occupato,nomi_file',
            'column_type' => 'i,s',
        );
        
        $this->table_descr_req = clone $this->table_descr;
        $this->table_descr_req['table'] = 'ass_req';    
        $this->table_descr_req['column_name']='email,password,user,nome,regione,indirizzo,CAP,sito_web';
        $this->table_descr_req['column_type']='s,s,s,s,s,s,s,s';
    }   

    public function upgrade_user($em, $type){
        if($type == $this->$type){
            $this->err_descr = 'ERROR: wrong type';
            return false;
        }
        $contr = new aifp_controller();
        $us_new = $contr->get_us_from_type($type);
        if($us_new == null){
            $this->err_descr = 'ERROR: wrong type';
            return false;
        }
        $params=array(
            'email'=>$em,
        );  
        $us = $contr->search_OnAll_users($params);
        if(!$us || count($us)==0){
            $this->err_descr = "ERROR: email is not correct";
            return false;
        }        
        if(!$us->delete_user()){
            $this->err_descr = $us->err_descr;
            return false;
        }
        if(!$us_new->insert_user($us->attributes, $us->attributes_descr)){
            $this->err_descr = $us->err_descr;
            return false;
        }
        $this->err_descr = '';
        return true;
    }
    
    public function show_files($id=-1){
        if($id > -1){
            $this->attributes['id'] = $id;
        }else if($this->attributes['id'] == -1){
            $this->err_descr = 'ERROR: association is not initialized';
            return false;
        }
        if(!$this->conn->status){
            $this->conn = new db_interface();
            if(!$this->conn->status){
                $this->err_descr = 'ERROR: databse is not ready';
                return false;
            }
        }
        $query = "SELECT * FROM $this->table_descr_file[table] WHERE $this->table_descr[key]=$this->attributes[id]";
        
        $res = $this->conn->query($query);
        if(!$res || count($res)== 0){
            $this->err_descr ="ERROR: general error";
            return false;
        }
        $files = array();
        for($i=0;$i < $res->num_rows;$i++){
            $res->data_seek($i);
            $files[$i] = $res->fetch_assoc();
        }
        $this->err_descr = '';
        return $files;        
    }

    public function register_evento ()
    {
        $this->err_descr = 'The association can\'t register into an event';
        return false;
    }
    
    public function upload_file($file_descr)
    {
        if($this->attributes['id'] == -1){
            $this->isok = 'Error, association is not initialize';
            return false;
        }
        $path = FILE_ASS.$this->id.'/';
        if(!(file_exists($path))){
           mkdir($path, 0777, true); 
        }
        //creazione del file
        $upfile = $path.$file_descr['userfile']['name'];
        $size = $file_descr['userfile']['size'];
        if (!move_uploaded_file($file_descr['userfile']['temp_name'], $upfile))
        {
            $this->err_descr = 'ERROR: an error occurred while uploading file';            
            return false;            
        }        
        $files = $this->show_files();        
        if(!$files){
            $this->err_descr ='ERROR: db is not ready';
            return false;
        }        
        $size = $files['occupato'] + $size;        
        $name = $this->table_descr_file['column_name'];
        $value = array(
            0 => $files.','.$file_descr['userfile']['name'],
            1 => $size,
        ); 
        $id_arr = array(
            0 => $this->table_descr_file['key'],
            1 => $this->attributes['id'],
            2 => $this->atributes['key_type'],
        );        
        if(!$this->conn->statement_update($this->table_descr_file['table'],$name,$value,'s',$id_arr)){
            $this->err_descr=$this->conn->error;
            return false;
        }
        $this->err_descr = '';
        return true;
    }
    
    public function download_file($filename)
    {
        if($this->attributes['id'] == -1){
            $this->err_descr = 'ERROR: association is not initialize';
            return false;
        }        
        $path = FILE_ASS.$this->id.'/';
        $filename = $path.$filename;
        if(!(file_exists($filename))){
           $this->err_descr='ERROR: File is not found ';
           return false;
        }        
        if(!download($filename)){
           $this->err_descr='ERROR: Impossible download file';
           return false; 
        }
        $this->err_descr = '';
        return true;                
    }
    
    public function delete_file($filename)
    {
        if($this->attributes['id'] == -1){
            $this->err_descr = 'ERROR: association is not initialize';
            return false;
        }        
        $path = FILE_ASS.$this->id.'/'.$filename;
        if(!(file_exists($path)))        {
           $this->err_descr='ERROR: we don\'t find any files for this association ';
           return false;
        }
        $size = filesize($path);
        if(!unlink($path)){
           $this->err_descr='ERROR: file is not deleted ';
           return false;
        }
        $f = $this->show_files();
        if(!$f){
            $this->err_descr = $this->conn->error;
            return false;
        }
        //Aggiorno lo spazio occupato e l'elenco dei file
        $size = $f['occupato'] - $size;
        $temp = explode(',',$f['nomi_file']);
        $files = '';        
        foreach ($temp as $value) {
            if($value != $filename){
                $files .= $value.',';
            }
        }
        $files = str_replace($files, '', count($files)-2);
        $name=$this->table_descr_file['column_name'];
        $type=$this->table_descr_file['column_type'];
        $value=array(
            0=>$files,
            1=>$size,
        );
        $id_arr = array(
            0 => $this->table_descr_file['key'],
            1=> $this->attributes['id'],
            2 => $this->table_descr['key_type'],
        );
        if(!$this->conn->statement_update($this->table_descr['table'],$name,$value,$type.$id_arr)){
           $this->err_descr=$this->conn->error;
           return false;
        }        
        return true;            
    }
    
    public function add_evento($params)
    {
        if($this->id == -1)
        {
            $this->isok = 'Association class have to be initialize';
            return false;
        }
        require_once 'evento_class.php';
        
        $ev = new evento();
        if( !($ev->add_evento($params['titolo'], $this, $params['indirizzo'], $params['data_inizio'], $params['data_fine'])) )
        {
            $this->isok = 'Impossible to add an event';
            return false;
        }
                $this->attributes_descr['punteggio'] += 100;
        $params_descr = array('punteggio' => $this->attributes_decr['punteggio']);
        $this->update_user(array(), $params_descr);
        if($this->err_descr != ''){return false;}
        return true;        
    }
       
    public function register_assoc($params){
        if(!is_array($params)){
            return false;
        }
        $i=0;
        $val= array();
        $name = extract_node($this->table_descr_req['column_user'],0);
        $type = extract_node($this->table_descr_req['column_type'],0);
        $keys = explode (',',$name);
        for($i=0;$i < count($keys);$i++){
            if(isset($params[$keys[$i]])){
                $val[$i]=$params[$keys[$i]];
            }else{
                $this->err_descr = 'ERROR: parameters is not correct';
                return false;
            }
        }
        if(!$this->conn->statement_insert($this->table_descr_req['table'],$name,$val,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }$this->err_descr = '';
        return true;
    }

}

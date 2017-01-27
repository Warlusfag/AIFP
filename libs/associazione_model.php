<?php


require_once 'user_model.php';
require_once 'aifp_controller.php';



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
        $this->table_descr['key_type'] = 'i';
        $this->table_descr['column_name']='email,password,user,nome,regione,indirizzo,CAP';
        $this->table_descr['column_descr']='sito_web,num_post,punteggio,componenti,esperto';
        $this->table_descr['column_type']='s,s,s,s,s,s,s';
        $this->table_descr['column_type_descr'] = 's,i,i,i,i';
                
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
            'key_type' => 'i',
            'column_name' => 'occupato,nomi_file',
            'column_type' => 'i,s',
        );
        
        $this->table_descr_req = clone $this->table_descr;
        $this->table_descr_req['table'] = 'ass_req';    
        $this->table_descr_req['column_name']='email,password,user,nome,regione,indirizzo,CAP,sito_web';
        $this->table_descr_req['column_type']='s,s,s,s,s,s,s,s';
    }
    
    public function upgrade_user($em, $type){
        $contr = new aifp_controller();
        $us_new = $contr->get_us_from_type($type);
        if($us_new == null || $us_new->table_descr['type'] == $this->table_descr['type']|| $us_new instanceof user){
            $this->err_descr = 'ERROR: wrong type';
            return false;
        }
        //Ora vado a cercare l'utente vecchiio
        $params=array(
            'email'=>$em,
        );  
        $us = $contr->search_OnAll_users($params, 1);
        if(!$us  || count($us) == 0){
            $this->err_descr ="ERROR: email is incorrect";
            return false;
        }
        $keys = array_keys($us[0]);
        foreach($keys as $k){
            if(is_string($k) ){
                $user = $this->get_user_from_pkey($k);
                if(is_object($user)){break;}
            }
        }
        $us_descr = $user->search_descr_user($params, 1);
        if(!$us_descr  || count($us_descr) == 0){
            $this->err_descr ="ERROR: email is incorrect";
            return false;
        }        
        $user->init($us[0], $us_descr[0]);
        //cancello il vecchio utente
        if(!$us->delete_user()){
            $this->err_descr = $us->err_descr;
            return false;
        }
        //Aggiorno i punteggi di entrambi 
        $us->attributes['associazione'] = $this->attributes[$this->table_descr['key']];
        $us->attributes_descr['punteggio'] += 300;       
        $us->upgrade_esperto();
        if(!$us_new->insert_user($us->attributes, $us->attributes_descr)){
            $this->err_descr = $us->err_descr;
            return false;
        }        
        $params = array( 'punteggio'=>$this->$this->attributes_descr['punteggio'],);
        $this->update(array(), $params);
        $this->err_descr = '';
        return true;
    }
    
    
    public function show_files(){
        if($this->attributes['id'] == -1){
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
        $path = FILE_ASS.$this->attributes['id'].'/';
        if(!(file_exists($path))){
           mkdir($path, 0777, true);
           return array();
        }
        $query = "SELECT * FROM ".$this->table_descr_file['table']." WHERE ".$this->table_descr['key']."=".$this->attributes['id'].";";
        
        $res = $this->conn->query($query);
        if(!$res){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $files = array();
        for($i=0;$i < $res->num_rows;$i++){
            $res->data_seek($i);
            $files[$i] = $res->fetch_array(MYSQLI_BOTH);
        }
        $this->err_descr = '';
        return $files;        
    }
    

    public function register_evento ($id_evento)
    {
        $this->err_descr = 'The association can\'t register into an event';
        return false;
    }
    
    public function upload_file($file_descr)
    {
        if($this->attributes['id'] == -1){
            $this->err_descr = 'Error, association is not initialize';
            return false;
        }
        $path = FILE_ASS.$this->attributes['id'].'/';
        if(!(file_exists($path))){
           mkdir($path, 0777, true);           
        }
        //creazione del file
        $namefile = basename($file_descr['userfile']['name']);
        $upfile = $path.$namefile;
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
        $size += $files['occupato'];
        $name = $this->table_descr_file['column_name'];
        $type = $this->table_descr_file['column_type'];
        $value = array(
            0 => $size,
            1 => $files['nomi_file'].','.$namefile,
        ); 
        $id_arr = array(
            0 => $this->table_descr_file['key'],
            1 => $this->attributes['id'],
            2 => $this->atributes['key_type'],
        );        
        if(!$this->conn->statement_update($this->tabe_descr_file['table'],$name,$value,$type,$id_arr)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr = '';
        return true;
    }
    
    public function download_file($filename)
    {
        if($this->attributes['id'] == -1){
            $this->err_descr = 'Error, association is not initialize';
            return false;
        }
        $path = FILE_ASS.$this->attributes['id'].'/';
        if(!(file_exists($path))){
           mkdir($path, 0777, true);
           $this->err_descr='ERROR: no such file or directory';
           return false;
        }       
        
        $filepath = $path.basename($filename);
        if(!(file_exists($filepath))){
           $this->err_descr='ERROR: File is not found ';
           return false;
        }        
        if(!download($filepath)){
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
        $filename = basename($filename);
        $path = FILE_ASS.$this->attributes['id'].'/'.$filename;
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
        $files = str_replace($files, '', count($files)-1);
        $name=$this->table_descr_file['column_name'];
        $type=$this->table_descr_file['column_type'];
        $value=array(
            0=>$size,
            1=>$files,            
        );
        $id_arr = array(
            0 => $this->table_descr_file['key'],
            1=> $this->attributes['id'],
            2 => $this->table_descr_file['key_type'],
        );
        if(!$this->conn->statement_update($this->table_descr['table'],$name,$value,$type,$id_arr)){
           $this->err_descr=$this->conn->error;
           return false;
        }
        $this->err_descr = '';
        return true;            
    }
    
    public function add_evento($params)
    {
        if($this->attributes['id'] == -1)
        {
            $this->err_descr = 'Association class have to be initialize';
            return false;
        }
        require_once 'evento_class.php';
        
        $ev = new evento();
        if( !($ev->add_evento($params, $this)) )
        {
            $this->err_descr = $ev->err_descr;
            return false;
        }
        $this->attributes_descr['punteggio'] += 100;
        $params_descr = array('punteggio' => $this->attributes_decr['punteggio']);
        $this->update_user(array(), $params_descr);
        if($this->err_descr != ''){return false;}
        return true;        
    }
       
    public function register_assoc($params){
        if(!is_array($params) || count($params)<=2){
            return false;
        }
        $flag = True;
        $i=0;
        $val= array();
        $keys = extract_node(explode(',',$this->table_descr_req['column_user']),0);
        $type = extract_node(explode(',',$this->table_descr_req['column_type']),0);        
        //non metto nessun controllo se tutti i campi sono presenti, in caso di errore sarà il DB a segnalarlo
        for($i=0;$i < count($keys);$i++){
            if(isset($params[$keys[$i]])){                
                $val[$i]=$params[$keys[$i]];
            }else{
                $flag = False;
            }
        }
        if(!$flag){
            $this->err_descr = "ERROR: bad input";
            return False;
        }            
        if(!$this->conn->statement_insert($this->table_descr_req['table'],$keys,$val,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr = '';
        return true;
    }

}

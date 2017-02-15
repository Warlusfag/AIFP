<?php
require_once 'user_model.php';
require_once 'aifp_controller.php';
require_once 'evento_model.php';
require_once 'conversazione_model.php';



class associazione extends user
{   
    public $table_descr_file;
    public $table_descr_req;
    public $attributes_req;
    
    function __construct() 
    {
        parent::__construct();
        $this->type= 'associazione';        
        
        $this->table_descr['table'] = 'associazioni';      
        $this->table_descr['key'] = 'ID_ass';
        $this->table_descr['key_type'] = 'i';
        $this->table_descr['column_name']='email,password,user,nome,regione,provincia,indirizzo,CAP,sito_web,num_post,punteggio,image,componenti';
        $this->table_descr['column_type']='s,s,s,s,s,s,s,s,s,i,i,s,i';                
        $this->attributes = array(
            'ID_ass' => -1,
            'email'=> 'default@aifp.com',            
            'password' => 'password',
            'user' =>'user',
            'nome' => 'associazione',
            'regione' => 'regione',
            'provincia' => 'provincia',
            'indirizzo' => 'indirizzo',
            'CAP' => '00000',
            'sito_web'=> '',
            'num_post' => 0,
            'punteggio' => 1,
            'image'=>DEFAULT_IMG,
            'componenti' => 2, 
        );        
        $this->table_descr_file = array(
            'table' => 'file_ass',
            'key' => 'fk_ass',
            'key_type' => 'i',
            'column_name' => 'occupato,nomi_file',
            'column_type' => 'i,s',
        );        
        $this->attributes_req = array(
            'email' =>'',
            'password'=>'',
            'user' => '',
            'nome'=>'',
            'regione'=>'',
            'provincia'=>'',
            'indirizzo'=>'',
            'CAP'=>'',
            'componenti'=>'',
            'sito_web'=>'',
        );
        
        $this->table_descr_req = $this->table_descr;
        $this->table_descr_req['table'] = 'request_ass';    
        $this->table_descr_req['column_name']='email,password,user,nome,regione,provincia,indirizzo,CAP,componenti,sito_web';
        $this->table_descr_req['column_type']='s,s,s,s,s,s,s,s,i,s';
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
        $us = $contr->get_user($params);

        //cancello il vecchio utente
        if(!$us->delete_user()){
            $this->err_descr = $us->err_descr;
            return false;
        }
        //Aggiorno i punteggi di entrambi 
        $us->attributes['associazione'] = $this->attributes[$this->table_descr['key']];
        $us->attributes['punteggio'] += 300;       
        $us->upgrade_esperto();
        if(!$us_new->insert_user($us->attributes)){
            $this->err_descr = $us->err_descr;
            return false;
        }        
        $params = array( 'punteggio'=> $this->attributes['punteggio'],);
        if($this->update($params)){
            $this->err_descr = '';
            return true;            
        }else{
            return false;
        }
        
    }    
    
    public function get_files(){
        $key = $this->attributes[$this->table_descr['key']]; 
        if( $key == -1){
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
        $path = FILE_ASS.$key.'/';
        if(!(file_exists($path))){
           mkdir($path, 0777, true);
           return array();
        }
        $query = "SELECT * FROM ".$this->table_descr_file['table']." WHERE '".$this->table_descr['key']."'=".$key.";";
        
        $res = $this->conn->query($query);
        if(!$this->conn->status){
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
        $key = $this->attributes[$this->table_descr['key']]; 
        if( $key == -1){
            $this->err_descr = 'ERROR: association is not initialized';
            return false;
        }
        $path = FILE_ASS.$key.'/';
        if(!(file_exists($path))){
           mkdir($path, 0777, true);           
        }
        //creazione del file
        $namefile = basename($file_descr['name']);
        $upfile = $path.$namefile;
        if(file_exists($upfile)){
            $this->err_descr = "ERROR: il file gia' esiste";
            return false;
        }
        $size = $file_descr['size'];
        if (!move_uploaded_file($file_descr['tmp_name'], $upfile)){
            $this->err_descr = 'ERROR: an error occurred while uploading file';            
            return false;            
        }        
        $files = $this->get_files();        
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
            1 => $key,
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
        $key = $this->attributes[$this->table_descr['key']]; 
        if( $key == -1){
            $this->err_descr = 'ERROR: association is not initialized';
            return false;
        }
        $path = FILE_ASS.$key.'/';
        if(!(file_exists($path))){
           mkdir($path, 0755, true);
           $this->err_descr='ERROR: no such file or directory';
           return false;
        }       
        $filepath = $path.basename($filename);
        if(!(file_exists($filepath))){
           $this->err_descr='ERROR: File is not found ';
           return false;
        }        
        $this->err_descr = '';
        return $filepath;                
    }
    
    public function delete_file($filename)
    {
        $key = $this->attributes[$this->table_descr['key']]; 
        if( $key == -1){
            $this->err_descr = "ERROR: associazione non inizializzata'";
            return false;
        }
        $filename = basename($filename);
        $path = FILE_ASS.$key.'/'.$filename;
        if(!(file_exists($path))){
           $this->err_descr='ERROR: we don\'t find any files for this association ';
           return false;
        }
        $size = filesize($path);
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
            1=> $key,
            2 => $this->table_descr_file['key_type'],
        );
        if(!$this->conn->statement_update($this->table_descr['table'],$name,$value,$type,$id_arr)){
           $this->err_descr=$this->conn->error;
           return false;
        }
        $this->err_descr = '';
        return true;            
    }
    
    public function add_evento($params){
        if($this->attributes[$this->table_descr['key']] == -1)
        {
            $this->err_descr = 'Association class have to be initialize';
            return false;
        }
        require_once 'evento_model.php';
        
        $ev = new evento();                
        if( !($ev->add_evento($params, $this->attributes[$this->table_descr['key']])) ){
            $this->err_descr = $ev->err_descr;
            return false;
        }
        $this->attributes['punteggio'] += 100;
        $params = array('punteggio' => $this->attributes['punteggio']);
        $this->update_user($params);
        if($this->err_descr != ''){return false;}
        return true;        
    }
       
    public function register_assoc($params){
        if(!is_array($params)){
            return false;
        }
        $i=0;
        $val= array();
        $name = $this->table_descr_req['column_name'];
        $type = $this->table_descr_req['column_type'];        
        //non metto nessun controllo se tutti i campi sono presenti, in caso di errore sarà il DB a segnalarlo
        foreach($this->attributes_req as $key=>$value){
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
        if(!$this->conn->statement_insert($this->table_descr_req['table'],$name,$val,$type)){
            $this->err_descr = $this->conn->error;
            return false;
        }
        $this->err_descr = '';
        return true;
    }

}

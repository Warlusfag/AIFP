<?php

require_once 'admin/db_interface.php';

class evento
{
    public $titolo;
    public $associazione;
    public $data_inzio;
    public $data_fine;
    public $descrizione;
    
    private $table = 'eventi';
    private $key = 'id_evento';
    private $conn;
    
    function __construct()
    {
        try{
            $this->conn = new db_interface();
            if($this->conn->status == true){
                $this->associazione = -1;     
            }
        }catch(Exception $ex){
            $this->associazione = -1;
        }
    }
    
    public function show_news ($limit){
        
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                return false;
            }
        }      
        
        $query="SELECT * FROM '$this->table' AS A WHERE A.data_inzio >= CURDATE() ORDER BY A.data_inzio LIMIT '$limit';";
        $res = $this->conn->query($query);
        if(($nr = $res->num_rows) > 0){
            $app = array();
            
            for($i=0;$i<$nr;$i++){
                $res->data_seek($i);
                $app[$i]=$res->fetch_assoc();
            }
            return $app;
        }else{
            return null;            
        }       
    }
    
    public function add_evento ($titolo, $ass, $ind, $tipologia, $data_inzio, $data_fine)
    {
        require_once PROJ_CLASS.'user_model.php';
        
        if( !($ass instanceof associazione) ){
            return false;
        }
        if(!$this->conn){
            $this->conn = new db_interface();
            if(!$this->conn){
                return false;
            }
        }
        $ev = self::search_evento(-1, $ass->get_id(), $titolo, $ass->regione, $data_inzio, $data_fine);
        if ($ev == null || count($ev)>0 ){
            return false;            
        }
        if (count($ev) == 0){
            $table='evventi';
            $name='id_ass,nome,tipologia,regione,provincia,data_inizio,data_fine';
            $type='i,s,s,s,s,da,da';
            $value=array(
                0=>$ass->get_id(),
                1=>$titolo,
                2=>$tipologia,
                3=>$ass->regione,
                4=>$ass->provincia,
                5=>$data_inzio,
                6=>$data_fine,
            );
            
            if(!$this->conn->statement_insert($table, $name, $value, $type)){
                return false;
            }
            return true;
        }
    }
    
    public function register_evento($id, $email)
    {       
        require_once 'user_model.php';
        
        $ev = self::search_evento($id);
        if ($ev == null || count($ev)==0 )
        {
            return false;            
        }
        if (count($ev) > 0)
        {
            $ass = associazione::search_assoc($ev['id_ass']);
            if(!$ass){
                return false;
            }
            
            $titolo = $ev['titolo'];
            $subject="AIFP: un utente si è inscritto al tuo evento: $titolo ";
            $text= "Gentile associazione ".$ass['nome'].","
                    . "con la presente email le vogliamo comunicare che un utente si appena inscritto "
                    . "al suo evento ";
            
            
            
            $subject="AIFP: email di conferma dell\'avenuta inscrizione all\'evento: $titolo ";
            $text= "Gentile utente,"
                    . "con la presente email le confermiamo l'avvenuta";
            
        }
    }
    
    static function search_evento($id=-1, $ass=-1, $titolo=-1, $regione, $data_inizio=-1, $data_fine=-1)
    {
        $conn = new db_interface();        
        
        $query="SELECT * FROM '$this->table' AS U WHERE ";
        $flag = false;

        if($id != -1)
        {            
            if($flag == true)
            {
                $query=$query." AND U.'$this->key'='$id' ";
            }
            else
            {
                $query=$query."U.'$this->key'='$id' ";
                $flag = true;
            }


        }
        if($ass != -1)
        {
            if($flag == true)
            {
                $query=$query." AND U.ass='$ass' ";
            }
            else
            {
                $query=$query."U.ass='$ass' ";
                $flag = true;
            }


        }
        if($titolo != -1)
        {
            if($flag == true)
            {
                $query=$query." AND U.titolo='$titolo' ";
            }
            else
            {
                $query=$query."U.titolo='$titolo' ";
                $flag=true;
            }


        }
        if($data_inizio != -1)
        {
            if($flag == true)
            {
                $query=$query." AND U.data_inzio='$data_inizio' ";
            }
            else
            {
                $query=$query."U.data_inzio='$data_inizio' ";
                $flag=true;
            }

        }
        if($data_fine != -1)
        {
            if($flag == true)
            {
                $query=$query." AND U.data_fine='$data_fine' ";
            }
            else
            {
                $query=$query."U.data_fine='$data_fine' ";
                $flag=true;
            }

        }
        
        $query=$query.';';
        $res = $conn->query($query);
        if(!$res){return null;}
        if(($nr = $res->num_rows) >= 0){
            $app=array();                
            for ($j=0; $j<$nr; $j++){
                $res->data_seek($j);
                $app[$j]=$res->fetch_assoc();
            }
            return $app;
        }
    }
        
    
}
<?php
require_once 'admin/setup.php';
require_once 'admin/utils.php';
require_once 'collection.php';

if (!isset($_SESSION['news'])){
    $_SESSION['news'] = serialize(new news_collection());
}
if (!isset($_SESSION['funghi'])){
    $_SESSION['funghi'] = serialize(new funghi_collection());
}



class aifp_controller
{

    public $tipo;    
    public $description;
    
    function __construct(){
        
        $this->description = "";
        $this->tipo = array(
            0 =>'utente',
            1 =>'inscritto',
            2=>'micologo',
            3=>'botanico',
            4=>'associazione',
            5=>'admin',
        );

    }  
    
    public function login($password, $email=-1, $user=-1, $type = -1){

        if($email==-1 && $user==-1){ 
         return false; 
        } 
        if($email!=-1){ 
            $params = array( 
                    'email'=>$email, 
                    'password'=>$password, 
            );             
        }else if ($user != -1){ 
            $params = array( 
                    'user'=>$user, 
                    'password'=>md5($password), 
            );             
        }
        //preparati i parametri li passo alla search on all user
        $us = $this->get_user($params, $type);
        if($this->description != ''){
            return false;
        }       
        $this->description =''; 
        return $us;        
    } 
    
    public function get_user($params, $type=-1){
        
        if(!is_array($params)||count($params) == 0){
            $this->description = 'ERROR:Bad parameters';
            return false;
        }
        $us = $this->search_OnAll_users($params, 1, $type);
        if(!$us || count($us)== 0 || count($us)>1){
            $this->description = "ERROR:Bad parameters";
            return false;
        }
        //se la ricerca è andata a buon fine devo creare l'oggetto in questione
        ////us è un array di array                                                                    
        if($type != -1){
            $user = $this->get_us_from_type($type);
        }else{
            //se non conosco il tipo a priori, devo ricercarlo tra le chiavi dell'array passatomi
            //controllo se stringhe perchè la search mi ritorn sia associativo che numerale
            $keys = array_keys($us[0]);
            foreach($keys as $k){
                if(is_string($k) ){
                    $user = $this->get_user_from_pkey($k);
                    if(is_object($user)){break;}
                }
            }            
        }
        $user->init($us[0]);
        $this->description =''; 
        return $user;            
    }

    function get_user_from_pkey($primary_key){
        $us = new user();
        if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new inscritto();
        if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new micologo();
         if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new botanico();
         if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new associazione();
         if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        return null;
    }

    function get_us_from_type($type){
        $us = new user();
        if($us->type == $type){
            return $us;
        }
        $us = new inscritto();
        if($us->type == $type){
            return $us;
        }
        $us = new micologo();
        if($us->type == $type){
            return $us;
        }
        $us = new inscritto();
        if($us->type == $type){
           return $us; 
        }
        $us = new associazione();
        if($us->type == $type){
            return $us;
        }
        $us = new admin();
        if($us->type == $type){
            return $us;
        }
        return null;   
    }
    
    /*@params=parametri passategli
     *@limit=limita il numero dei risultati come output della ricerca. Se -1 non c'è limite ai risultati
     * se liomit =1 ritorna l'ogetto relativo a quell'utente
     * @type= determina se circoscrivere la ricerca ad una sola tabella data da tipo
     */
    function search_OnAll_users($params, $limit=-1, $type=-1){ 
       $ris = array();
       //controllo se è stato passato un tipo ed imposto il limite del ciclo
       if($type != -1){ 
        $n = 1; 
       }else{ 
           $n = count($this->tipo); 
       } 
       for($i=0;$i<$n;$i++){
           //Ora inzializzo l'ogetto a seconda del tipo
            if($type != -1){ 
                 $us = $this->get_us_from_type($type); 
                 if($us == null){
                     $this->description = "ERROR:Wrong type";
                     return false; 
                 }                 
            }else{ 
                 $us = $this->get_us_from_type($this->tipo[$i]); 
            }      
           //Ricerco l'utente
            $t = $us->search_user($params, $limit);
            //se type è uguale a meno uno e con un utente di una tipologia non l'ho trovato vado 
            if($us->err_descr == ''){
                //se in una tabella non ho trovato niente e non conosco il tipo non significa che nella prossima
               // non lo troverò
                if(count($t) == 0){
                    if($type == -1){
                        continue;
                    }else{
                        break;
                    }
                }
               if($limit == -1){ 
                    $ris = array_merge($ris, $t);
                //Caso in cui limit è settato   
               }else if(count($t) == $limit){
                    $ris = array_merge($ris, $t);
                    break;
               }else if(count($t) < $limit){
                    $ris = array_merge($ris, $t);
                    $limit -= count($t);
               }                       
            }else{
               $this->description = $us->err_descr;
               return false;
            }
       } 
       return $ris;	 
    }
    
    //popola la collection  per le sezioni
    public function forum(){
        
        $sez = new sezione();        
        $t = $sez->search_sezioni(array(), -1, limit_sez);
        if($sez->err_descr != ''){
            $this->description = $sez->err_descr;
            return false;
        }
        $temp = array();
        for($i=0;$i<count($t);$i++){
            $sez = new sezione();
            $sez->init($t[$i]);
            $temp[$i] = $sez;
        }
        $this->description = '';
        return $temp;               
    }
    //Popola la collection delle news
    public function get_news(){

        $ev = new evento();
        $news = $ev->show_news(20);            
        if($ev->err_descr != ''){
            $this->description = $ev->err_descr;
            return false;
        }
        $this->description = '';
        return $news;
    }
    //Popola la collection dei funghi, cioè quei funghi visualizzati nella pagina principale e più famosi
    //dal front end gliu viene passato il genere
    public function get_scheda_funghi($genere){
        //controlla se è presente
        $g = array_values(funghi::$generi);
        if(array_search($genere,$g)){
            //se già è presente nella collection non c'è bisogno di ritrovarlo ma ritorna la collection
            $model_fungo = new funghi();                         
            $params = array(
                'genere'=>$genere,
            );
            $funghi = $model_fungo->search_funghi($params, -1, 10);
            if($model_fungo->err_descr !=''){
                $this->description = $model_fungo->err_descr;
                return false;
            }
            $this->description = '';
            return $funghi;
            
        }else{
            $this->description ="ERROR:bad parameters";
            return false;
        }
    }
    
    public function get_schede_piante($genere){
        
    }
    //Se non gli passo niente ricerco i primi n prodotti che trovo nel DB
    public function get_prodotti($genere=-1){
        
    }
}
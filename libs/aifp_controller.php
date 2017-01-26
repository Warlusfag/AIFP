<?php

require_once 'admin/setup.php';
require_once 'admin/utils.php';
require_once "user_model.php";
require_once "associazione_model.php";
require_once "evento_model.php";
require_once "admin_model.php";

//limit constant
const limit_sez = 5;
const limit_events = 20;
const limit_session = 1000000;

class aifp_controller
{
    static public $collection_user;
    static public $collection_sez;
    static public $collection_news;
    static public $collection_funghi;
    public $tipo;
    
    public $descritpion;
    
    function __constructor(){
        
        $this->descritpion = "";
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
        if(!self::$collection_user){ 
                self::$collection_user = array(); 
        }
        if($email==-1 && $user==-1){ 
         return false; 
        } 
        if($email!=-1){ 
            $params = array( 
                    'email'=>$email, 
                    'password'=>md5($password), 
            );             
        }else if ($user != -1){ 
            $params = array( 
                    'user'=>$user, 
                    'password'=>md5($password), 
            );             
        }
        //preparati i parametri li passo alla search on all user
        $us = $this->search_OnAll_users($params, 1, $type);
        if(!$us || count($us)== 0 || count($s)>1){
            $this->description = "ERROR: mail or username or password are not correct";
            return false;
        }
        //se la ricerca è andata a buon fine devo creare l'oggetto in questione
        ////us è un array di array 
        //sullo 0 c'è l'array con i risultati e ne estraggo le chiavi
        $k = array_keys($us[0]);
        if($type == -1){
            $user = $this->get_us_from_type($type);
        }else{        
            $user = $this->get_user_from_pkey($k[0]);
        }
        //allo 00 c'è il valore della chiave
        $params = array(
            $k[0] => $us[0][0],
        );
        //trovo ora il resto della descrizione dell'utente
        $us_descr= $user->search_descr_user($params, 1);		
        $user->init($us, $us_descr);
        //preparo il token da mettere nell'array session
        $token = md5($email.$password); 
        self::$collection_user[$token] = $user; 
        $this->descritpion =''; 
        return $token;        
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
                     $this->descritpion = "ERROR:Wrong type";
                     return false; 
                 }                 
            }else{ 
                 $us = $this->get_us_from_type($this->tipo[$i]); 
            }      
           //Ricerco l'utente
            $t = $us->search_user($params, $limit);
            if($t){
               if($limit == -1){ 
                    array_merge($ris, $t);
                //Caso in cui limit è settato   
               }else if(count($t) == $limit){
                    array_merge($ris, $t);
                    break;
               }else if(count($t) < $limit){
                    array_merge($ris, $t);
                    $limit -= count($t);
               }                       
            }else{
               $this->descritpion = $us->err_descr;
               return false;
            }
       } 
       return $ris;	 
    }

    function search_OnAll_descr_users($params, $limit=-1, $type=-1){  
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
                    $this->descritpion = "ERROR:Wrong type";
                    return null; 
                }                 
           }else{ 
                $us = $this->get_us_from_type($this->tipo[$i]); 
           }      
           //Ricerco l'utente
           $t = $us->search_descr_user($params); 
           //Caso in cui i risultati sono illimitati
           if($t){
               if($limit == -1){ 
                    array_merge($ris, $t);
                //Caso in cui limit è settato   
               }else if(count($t) == $limit){
                    array_merge($ris, $t);
                    break;
               }else if(count($t) < $limit){
                    array_merge($ris, $t);
                    $limit -= count($t);
               }                       
            }else{
               $this->descritpion = $us->err_descr;
               return false;
            }
       } 
       return $ris;	 
    }
    //popola la collection  per le sezioni
    public function forum(){
        require_once "sezione_model.php";
        
        if(!self::$collection_sez){
            self::$collection_sez = array();
        }        
        $temp = new sezione();        
        $t = $temp->search_sezioni(array(), -1, limit_sez);
        if(!$t){
            $this->descritpion = $temp->err_descr;
            return false;
        }else{       
            for($i=0;$i<count($t);$i++){
                $sez = new sezione();
                $sez->init($t[$i]);
                self::$collection_sez[$i] = $sez;
            }
            $this->descritpion = '';
            return $t;
        }       
    }
    //Popola la collection delle news
    public function get_news(){
        if(evento::$inserted || count(self::$collection_news)==0){
            $ev = new evento();
            $news = $ev->show_news(20);            
            if(!$news){
                $this->descritpion = $ev->err_descr;
                return false;
            }
        }
        $this->descritpion = '';
        return self::$collection_news;
    }
    //Popola la collection dei funghi, cioè quei funghi visualizzati nella pagina principale e più famosi
    //dal front end gliu viene passato il genere
    public function get_scheda_funghi($genere){
        if(!self::$collection_funghi){
            self::$collection_funghi = array();            
        }
        //controlla se è presente
        $g = array_values(funghi::$generi);
        if(array_search($genere,$g)){
            //se già è presente nella collection non c'è bisogno di ritrovarlo ma ritorna la collection
            if(isset(self::$collection_funghi[$genere])){
                $this->descritpion = '';
                return self::$collection_funghi[$genere];
            //altrimenti lo devo scaricare
            }else{
                $model_fungo = new funghi();                         
                $params = array(
                    'genere'=>$genere,
                );
                self::$collection_funghi[$genere] = $model_fungo->search_funghi($params, -1, 10);
                if(!self::$collection_funghi[$genere]){
                    $this->descritpion = $model_fungo->err_descr;
                    return null;
                }
                $this->descritpion = '';
                return self::$collection_funghi[$genere];
            }
        }else{
            $this->descritpion ="ERROR:wrong genere";
            return null;
        }
    }    
}